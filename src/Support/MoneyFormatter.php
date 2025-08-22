<?php

namespace Andreg\LaravelEssentials\Support;

use Illuminate\Support\Number;

class MoneyFormatter {

	public function __construct(
		protected string $currencyCode = 'USD',
		protected ?string $locale = null
	) {
		if ( 3 !== strlen( $this->currencyCode ) ) {
			throw new \InvalidArgumentException( 'Invalid currency code' );
		}

		$this->locale = $locale ?? ( app()->bound( 'translator' ) ? app()->getLocale() : 'en' );
	}

	public function display( string $amount, bool $abbreviate = false ): string|false {
		if ( true === $abbreviate ) {
			// Get the properly formatted currency for reference
			$normalFormatted = Number::currency(
				number: 1,
				in: $this->currencyCode,
				locale: $this->locale
			);

			// Get abbreviated amount
			$abbreviatedAmount = Number::abbreviate( floatval( $amount ), 1, 2 );

			// Fix decimal separator to match locale
			// Get a sample number to determine the locale's decimal separator
			$sampleFormatted = Number::currency( 1.5, $this->currencyCode, $this->locale );
			if ( is_string( $sampleFormatted ) && is_string( $abbreviatedAmount ) && str_contains( $sampleFormatted, '1,5' ) ) {
				// Locale uses comma as decimal separator
				$abbreviatedAmount = str_replace( '.', ',', $abbreviatedAmount );
			}

			$result = '';

			// Replace the number part with our abbreviated amount
			// This handles formats like "$1.00", "1,00 €", etc.
			if ( is_string( $normalFormatted ) && is_string( $abbreviatedAmount ) ) {
				$result = preg_replace( '/1(?:[.,]\d+)?/', $abbreviatedAmount, $normalFormatted );
			}

			return (string) $result;
		}

		return Number::currency(
			number: floatval( $amount ),
			in: $this->currencyCode,
			locale: $this->locale
		);
	}

	public function abbreviated( string $amount ): string|false {
		return $this->display( $amount, true );
	}

}
