<?php

use Andreg\Essentials\Support\Numbers;

describe( 'Numbers', function () {
	test( 'string numbers can be normalized to float', function () {
		$amount1 = '123.456,78';
		$amount2 = '123,456.78';

		expect( Numbers::normalize( $amount1 ) )
			->toBe( Numbers::normalize( $amount2 ) )
			->toBe( 123456.78 );
	} );

	test( 'float numbers can be formatted according to the locale', function () {
		$amount = 123456.78;

		expect( Numbers::format( $amount, 'en' ) )
			->toBe( '123,456.78' );

		expect( Numbers::format( $amount, 'it' ) )
			->toBe( '123.456,78' );

		expect( Numbers::format( $amount, 'fr' ) )
			->toBe( "123\u{202F}456,78" );

		expect( Numbers::format( $amount, 'de' ) )
			->toBe( '123.456,78' );
	} );
} );
