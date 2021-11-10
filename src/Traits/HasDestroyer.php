<?php

namespace Digitalion\LaravelModelEditors\Traits;

trait HasDestroyer
{
	/**
	 * Boot the editors trait for a model.
	 *
	 * @return void
	 */
	public static function bootHasDestroyer()
	{
		static::deleting(function ($model) {
			$model->deleted_by = auth()->check() ? auth()->id() : null;
			$model->save();
		});
	}

	/**
	 * Get the user that destroy the model.
	 */
	public function destroyer()
	{
		$user_model = 'App\\';
		if (intval((explode('.', app()->version()))[0]) >= 8) $user_model .= 'Models\\';
		$user_model .= 'User';

		return $this->belongsTo($user_model, 'created_by');
	}
}
