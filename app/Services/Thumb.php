<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Intervention\Image\Facades\Image;


class Thumb
{
	/**
	 * Make thumb if Post model
	 *
	 * @param \Illuminate\Database\Eloquent\Model $model
	 * @return void
	 */
	public static function makeThumb(Model $model)
	{
		if ($model instanceof Post) {
			$path = $model->image;
			$base64Image = base64_encode(file_get_contents($model->image));
			$dir = dirname($path);
			if ($dir != '\files') {
				$dir = substr_replace($dir, '', 0, 7);
				if (! in_array($dir, Storage::disk('thumbs')->directories())) {
					Storage::disk('thumbs')->makeDirectory($dir);
				}
			}
			$image = Image::make($base64Image)->widen(100);
			Storage::disk('thumbs')->put(substr_replace(self::makeThumbPath($path), '', 0, 7), $image->encode());
		}
	}
	
	/**
	 * Make thumb path
	 *
	 * @param $path
	 * @return mixed
	 */
	public static function makeThumbPath($path)
	{
		$path = substr_replace($path, '/thumbs', 0, 5);
		return substr_replace($path, '-thumb', -4, 0);
	}
}
