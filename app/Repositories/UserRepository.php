<?php

namespace App\Repositories;

use App\Models\User;
use DB;
use Hash;

class UserRepository
{
	/**
	 * The Model instance.
	 *
	 * @var \Illuminate\Database\Eloquent\Model
	 */
	protected $model;
	
	public function __construct(User $user)
	{
		$this->model = $user;
	}
	
	/**
	 * Get users collection paginate.
	 *
	 * @param  int $nbrPages
	 * @param  array $parameters
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function getAll($nbrPages, $parameters)
	{
		return User::with('ingoing')
			->orderBy($parameters['order'], $parameters['direction'])
			->when(($parameters['role'] !== 'all'), function ($query) use ($parameters) {
				$query->whereRole($parameters['role']);
			})->when($parameters['valid'], function ($query) {
				$query->whereValid(true);
			})->when($parameters['confirmed'], function ($query) {
				$query->whereConfirmed(true);
			})->when($parameters['new'], function ($query) {
				$query->has('ingoing');
			})->paginate($nbrPages);
	}
	
	/**
	 * Update a user.
	 *
	 * @param  \App\Http\Requests\UserUpdateRequest $request
	 * @param  \App\Models\User $user
	 * @return void
	 */
	public function update($request, $user)
	{
		$inputs = $request->all();
		
		if (isset($inputs['confirmed'])) {
			$inputs['confirmed'] = true;
		}
		
		if (isset($inputs['valid'])) {
			$inputs['valid'] = true;
		}
		
		$user->update($inputs);
		
		if (! $request->has('new') && $user->ingoing) {
			$user->ingoing->delete();
		}
	}
	
	public function getUser($id)
	{
		return $this->model->select()->where('id', '=', $id)->first();
	}
	
	public function Edit($record, $user)
	{
		if ($record['password'] == NULL)             //if new_pw null, save as old pw
			$password = $user->password;
		else
			$password = Hash::make($record['password']);        //make a new hashed pw
		
		return DB::table('users')->where('id', $user->id)
			->update([
				'name' => $record['name'],
				'email' => $record['email'],
				'updated_at' => $record['updated_at'],
				'password' => $password
			]);
	}
}
