<?php

namespace Andreg\LaravelEssentials\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string display($amount, bool $abbreviate = false)
 * @method static string abbreviated($amount)
 * @method static \Andreg\LaravelEssentials\Support\MoneyFormatter currency(string $currencyCode, ?string $locale = null)
 *
 * @see \Andreg\LaravelEssentials\Support\MoneyFormatter
 */
class Money extends Facade {

	/**
	 * Get the registered name of the component.
	 */
	protected static function getFacadeAccessor(): string {
		return 'laravel_essentials_money';
	}

	/**
	 * Create a new Money instance with the specified currency.
	 */
	public static function currency( string $currencyCode, ?string $locale = null ): \Andreg\LaravelEssentials\Support\MoneyFormatter {
		return new \Andreg\LaravelEssentials\Support\MoneyFormatter( $currencyCode, $locale );
	}

}
