<?php

namespace Andreg\LaravelEssentials\Providers;

use Andreg\LaravelEssentials\Support\Money;
use Illuminate\Support\ServiceProvider;

class LaravelEssentialsServiceProvider extends ServiceProvider {

	/**
	 * Register services.
	 */
	public function register(): void {
		$this->app->bind( 'money', function ( $app ) {
			return new Money();
		} );
	}

	/**
	 * Bootstrap services.
	 */
	public function boot(): void {
		//
	}

}
