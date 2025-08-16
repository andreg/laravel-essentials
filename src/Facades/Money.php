<?php

namespace Andreg\LaravelEssentials\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string display($amount, bool $abbreviate = false)
 * @method static string abbreviated($amount)
 * @method static \Andreg\LaravelEssentials\Support\Money currency(string $currencyCode, ?string $locale = null)
 *
 * @see \Andreg\LaravelEssentials\Support\Money
 */
class Money extends Facade {

	/**
	 * Get the registered name of the component.
	 */
	protected static function getFacadeAccessor(): string {
		return 'money';
	}

	/**
	 * Create a new Money instance with the specified currency.
	 */
	public static function currency( string $currencyCode, ?string $locale = null ): \Andreg\LaravelEssentials\Support\Money {
		return new \Andreg\LaravelEssentials\Support\Money( $currencyCode, $locale );
	}

}
