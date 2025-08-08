<?php

namespace Andreg\Essentials\Support;

class Numbers {

	/**
	 * Format a number according to the specified locale.
	 *
	 * @param float $value The number to format.
	 * @param string $locale The locale code (e.g., 'en', 'it', 'fr', 'de').
	 * @return string The formatted number.
	 */
	public static function format( float $value, string $locale ): string {
		$formatter = new \NumberFormatter( $locale, \NumberFormatter::DECIMAL );
		$formatter->setAttribute( \NumberFormatter::FRACTION_DIGITS, 2 );

		$formattedValue = $formatter->format( $value );

		if ( false === $formattedValue ) {
			throw new \InvalidArgumentException( "Invalid number format for locale: $locale" );
		}

		return $formattedValue;
	}

	/**
	 * Normalize a string representation of a number to a float.
	 *
	 * This method handles different formats, such as '123.456,78' and '123,456.78',
	 * converting them to a standard float representation.
	 *
	 * @param string $value The string representation of the number.
	 * @return float The normalized float value.
	 */
	public static function normalize( string $value ): float {
		$value = str_replace( ',', '.', $value );

		if ( substr_count( $value, '.' ) > 1 ) {
			$lastDotPos = intval( strrpos( $value, '.' ) );
			$value      = str_replace( '.', '', substr( $value, 0, $lastDotPos ) ) . substr( $value, $lastDotPos );
		}

		return (float) $value;
	}

}
