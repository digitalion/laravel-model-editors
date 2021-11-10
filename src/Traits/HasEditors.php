<?php

namespace Digitalion\LaravelModelEditors\Traits;

trait HasEditors
{
	/**
	 * Boot the editors trait for a model.
	 *
	 * @return void
	 */
	public static function bootHasEditors()
	{
		static::saving(function ($model) {
			$model->updated_by = auth()->check() ? auth()->id() : null;
		});

		static::creating(function ($model) {
			$model->created_by = auth()->check() ? auth()->id() : null;
		});
	}

	/**
	 * Get the user that created the model.
	 */
	public function creator()
	{
		$user_model = 'App\\';
		if (intval((explode('.', app()->version()))[0]) >= 8) $user_model .= 'Models\\';
		$user_model .= 'User';

		return $this->belongsTo($user_model, 'created_by');
	}

	/**
	 * Get the user that edited the model.
	 */
	public function modifier()
	{
		$user_model = 'App\\';
		if (intval((explode('.', app()->version()))[0]) >= 8) $user_model .= 'Models\\';
		$user_model .= 'User';

		return $this->belongsTo($user_model, 'updated_by');
	}
}
