<?php

use Andreg\LaravelEssentials\Support\NumberFormatter;

describe( 'Numbers', function () {
	test( 'string numbers can be normalized to float', function () {
		$amount1          = '123.456,78';
		$amount2          = '123,456.78';
		$numbersFormatter = new NumberFormatter();

		expect( $numbersFormatter->normalize( $amount1 ) )
			->toBe( $numbersFormatter->normalize( $amount2 ) )
			->toBe( 123456.78 );
	} );

	test( 'float numbers can be formatted according to the locale', function () {
		$amount           = 123456.78;
		$numbersFormatter = new NumberFormatter();

		expect( $numbersFormatter->format( $amount, 'en' ) )
			->toBe( '123,456.78' );

		expect( $numbersFormatter->format( $amount, 'it' ) )
			->toBe( '123.456,78' );

		expect( $numbersFormatter->format( $amount, 'fr' ) )
			->toBe( "123\u{202F}456,78" );

		expect( $numbersFormatter->format( $amount, 'de' ) )
			->toBe( '123.456,78' );
	} );
} );
