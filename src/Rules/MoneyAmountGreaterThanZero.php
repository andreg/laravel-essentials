<?php

namespace Andreg\Essentials\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MoneyAmountGreaterThanZero implements ValidationRule {

	/**
	 * Run the validation rule.
	 */
	public function validate( string $attribute, mixed $value, Closure $fail ): void {
		$value = str_replace( ',', '.', $value );

		if ( substr_count( $value, '.' ) > 1 ) {
			$lastDotPos = strrpos( $value, '.' );
			$value      = str_replace( '.', '', substr( $value, 0, $lastDotPos ) ) . substr( $value, $lastDotPos );
		}

		// Ensure the value is in a format that can be converted to float
		if ( floatval( $value ) <= 0 ) {
			$fail( 'The :attribute must be greater than 0.' );
		}
	}

}
