<?php

namespace Andreg\LaravelEssentials\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string format(float $value, string $locale, int $fractionDigits = 2)
 * @method static float normalize(string $value)
 *
 * @see \Andreg\LaravelEssentials\Support\NumberFormatter
 */
class Numbers extends Facade {

	/**
	 * Get the registered name of the component.
	 */
	protected static function getFacadeAccessor(): string {
		return 'laravel_essentials_number';
	}

}
