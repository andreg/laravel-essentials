<?php

namespace Andreg\LaravelEssentials\Providers;

use Andreg\LaravelEssentials\Support\MoneyFormatter;
use Andreg\LaravelEssentials\Support\NumberFormatter;
use Illuminate\Support\ServiceProvider;

class LaravelEssentialsServiceProvider extends ServiceProvider {

	/**
	 * Register services.
	 */
	public function register(): void {
		$this->app->bind( 'laravel_essentials_money', function ( $app ) {
			return new MoneyFormatter();
		} );

		$this->app->bind( 'laravel_essentials_number', function ( $app ) {
			return new NumberFormatter();
		} );
	}

	/**
	 * Bootstrap services.
	 */
	public function boot(): void {
		//
	}

}
