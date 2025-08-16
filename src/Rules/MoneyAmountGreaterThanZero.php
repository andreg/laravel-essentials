<?php

namespace Andreg\LaravelEssentials\Rules;

use Andreg\LaravelEssentials\Support\NumberFormatter;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MoneyAmountGreaterThanZero implements ValidationRule {

	/**
	 * Run the validation rule.
	 */
	public function validate( string $attribute, mixed $value, Closure $fail ): void {
		$value = ( new NumberFormatter() )->normalize( strval( $value ) );

		if ( $value <= 0 ) {
			$fail( 'The :attribute must be greater than 0.' );
		}
	}

}
