<?php

namespace Andreg\Essentials\Support;

class Numbers {

	public static function format( float $value, string $locale ): string {
		$formatter = new \NumberFormatter( $locale, \NumberFormatter::DECIMAL );
		$formatter->setAttribute( \NumberFormatter::FRACTION_DIGITS, 2 );

		return $formatter->format( $value );
	}

	public static function normalize( string $value ): float {
		$value = str_replace( ',', '.', $value );

		if ( substr_count( $value, '.' ) > 1 ) {
			$lastDotPos = strrpos( $value, '.' );
			$value      = str_replace( '.', '', substr( $value, 0, $lastDotPos ) ) . substr( $value, $lastDotPos );
		}

		return (float) $value;
	}

}
