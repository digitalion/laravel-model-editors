<?php

namespace Digitalion\LaravelModelEditors\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Blueprint::macro('editors', function () {
			$this->unsignedBigInteger('created_by')->nullable();
			$this->unsignedBigInteger('updated_by')->nullable();

			$this->foreign('created_by')->references('id')->on('users')->constrained()->nullOnDelete();
			$this->foreign('updated_by')->references('id')->on('users')->constrained()->nullOnDelete();
		});
		Blueprint::macro('destroyer', function () {
			$this->unsignedBigInteger('deleted_by')->nullable();

			$this->foreign('deleted_by')->references('id')->on('users')->constrained()->nullOnDelete();
		});
	}
}
