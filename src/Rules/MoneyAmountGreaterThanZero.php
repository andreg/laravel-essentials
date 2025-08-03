<?php

namespace Andreg\Essentials\Rules;

use Andreg\Essentials\Support\Numbers;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MoneyAmountGreaterThanZero implements ValidationRule {

	/**
	 * Run the validation rule.
	 */
	public function validate( string $attribute, mixed $value, Closure $fail ): void {
		$value = Numbers::normalize( strval( $value ) );

		if ( $value <= 0 ) {
			$fail( 'The :attribute must be greater than 0.' );
		}
	}

}
