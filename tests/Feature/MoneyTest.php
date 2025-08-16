<?php

use Andreg\LaravelEssentials\Support\MoneyFormatter;

describe( 'Money', function () {
	describe( 'constructor', function () {
		test( 'creates instance with default USD currency', function () {
			expect( ( new MoneyFormatter( locale: 'en' ) )->display( 100 ) )->toBe( '$100.00' );
			expect( ( new MoneyFormatter( locale: 'it' ) )->display( 100 ) )->toBe( "100,00\u{00a0}USD" );
		} );

		test( 'creates instance with custom currency code', function () {
			expect( ( new MoneyFormatter( currencyCode: 'EUR', locale: 'en' ) )->display( 100 ) )->toBe( '€100.00' );
			expect( ( new MoneyFormatter( currencyCode: 'EUR', locale: 'it' ) )->display( 100 ) )->toBe( "100,00\u{00a0}€" );
		} );

		test( 'throws exception for invalid currency code', function () {
			expect( fn () => new MoneyFormatter( 'US' ) )
				->toThrow( InvalidArgumentException::class, 'Invalid currency code' );
		} );

		test( 'throws exception for empty currency code', function () {
			expect( fn () => new MoneyFormatter( '' ) )
				->toThrow( InvalidArgumentException::class, 'Invalid currency code' );
		} );

		test( 'throws exception for too long currency code', function () {
			expect( fn () => new MoneyFormatter( 'USDX' ) )
				->toThrow( InvalidArgumentException::class, 'Invalid currency code' );
		} );
	} );

	describe( 'abbreviated method', function () {
		test( 'handles decimal amounts correctly', function () {
			expect( ( new MoneyFormatter( 'USD', 'en_US' ) )->abbreviated( 1500 ) )
				->toBe( '$1.5K' );

			expect( ( new MoneyFormatter( 'USD', 'it' ) )->abbreviated( 1500 ) )
				->toBe( "1,5K\u{00a0}USD" );
		} );
	} );

	describe( 'edge cases', function () {
		test( 'handles zero amount', function () {
			$money = new MoneyFormatter( 'USD', 'en_US' );

			expect( $money->abbreviated( 0 ) )
				->toBe( '$0' );
		} );

		test( 'handles negative amounts', function () {
			$money = new MoneyFormatter( 'USD', 'en_US' );

			$result = $money->abbreviated( -1000 );
			expect( $result )->toBe( '$-1K' );
		} );

		test( 'handles very large amounts', function () {
			$money = new MoneyFormatter( 'USD', 'en_US' );

			expect( $money->abbreviated( 1000000000000 ) )
				->toBe( '$1T' );
		} );
	} );
} );
