<?php

namespace App\Http\Controllers\Back;

use App\ {
	Http\Controllers\Controller,
	Models\User,
	Repositories\UserRepository,
	Http\Requests\UserUpdateRequest
};
use DateTime;
use Validator;
use Request;
use Hash;

class UserController extends Controller
{
	use Indexable;
	
	/**
	 * Create a new UserController instance.
	 *
	 * @param  \App\Repositories\UserRepository $repository
	 */
	public function __construct(UserRepository $repository)
	{
		$this->repository = $repository;
		
		$this->table = 'users';
	}
	
	/**
	 * Update "new" field for user.
	 *
	 * @param  \App\Models\User $user
	 * @return \Illuminate\Http\Response
	 */
	public function updateSeen(User $user)
	{
		$user->ingoing->delete();
		
		return response()->json();
	}
	
	/**
	 * Update "valid" field for user.
	 *
	 * @param  \App\Models\User $user
	 * @return \Illuminate\Http\Response
	 */
	public function updateValid(User $user)
	{
		$user->valid = true;
		$user->save();
		
		return response()->json();
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\User $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user)
	{
		return view('back.users.edit', compact('user'));
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UserUpdateRequest $request
	 * @param  \App\Models\User $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(UserUpdateRequest $request, User $user)
	{
		$this->repository->update($request, $user);
		
		return back()->with('user-updated', __('The user has been successfully updated'));
	}
	
	/**
	 * Remove the user from storage.
	 *
	 * @param  \App\Models\User $user
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user)
	{
		$user->delete();
		
		return response()->json();
	}
	
	/**
	 * Get current user.
	 *
	 * @param  int user_id
	 * @return array
	 */
	public function getUserInfo($id)
	{
		$profile = $this->repository->getUser($id);
		
		return view('back.profile', compact('profile'));
	}
	
	/**
	 * User update information
	 *
	 * @param  $request
	 * @return array[result, review new_info]
	 */
	public function editUser(Request $request)
	{
		$id = $request::input('user_id');
		$validator = Validator::make($request::all(), [
			'user_name' => 'bail|required|max:255|unique:users,name,' . auth()->user()->id,
			'user_email' => 'bail|required|email|max:255|unique:users,email,' . auth()->user()->id,
			'user_pw' => 'bail|required|max:255|min:6',
			'user_pw_new' => 'bail|confirmed'
		], [
				'user_name.required' => 'Username is required !',
				'user_mail.require' => 'Email is required !',
				'user_pw.required' => 'Password is required !',
				'user_pw_new.confirmed' => 'Reconfirm your new password please !'
			]
		);
		
		if ($validator->fails()) {          //check required input and confirmed pw
			return redirect()->back()
				->with(['msg' => $validator->messages()->all()])
				->withInput();
		} else if (! Hash::check($request::input('user_pw'), auth()->user()->password)) {            //check if the input pw match with DB
			return redirect()->back()
				->with(['msg' => ['The specified password does not match the database password']])
				->withInput();
		} else {
			$inputs = $request::all();
			$record = ([
				'name' => $inputs['user_name'],
				'email' => $inputs['user_email'],
				'password' => $inputs['user_pw_new'],
				'updated_at' => new DateTime()
			]);
			
			$result = $this->repository->Edit($record, auth()->user());
			if ($result)
				$mess = ([
					"mess" => "Your profile has been updated !!",
					"stt" => $result
				]);
			else
				$mess = ([
					"mess" => "Something went wrong, please check !!",
					"stt" => $result
				]);
			$profile = $this->repository->getUser($id);
			return view('back.profile', compact('mess', 'profile'));
		}
	}
}
