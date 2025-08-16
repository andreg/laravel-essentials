<?php

use Andreg\LaravelEssentials\Support\Money;

describe( 'Money', function () {
	describe( 'constructor', function () {
		test( 'creates instance with default USD currency', function () {
			$money = new Money();

			expect( $money->display( 100 ) )
				->toContain( '$' )
				->toContain( '100' );
		} );

		test( 'creates instance with custom currency code', function () {
			$money = new Money( 'EUR' );

			expect( $money->display( 100 ) )
				->toContain( '€' )
				->toContain( '100' );
		} );

		test( 'creates instance with custom locale', function () {
			$money = new Money( 'EUR', 'it' );

			$result = $money->display( 1000.50 );

			expect( $result )
				->toContain( '€' )
				->toContain( '1.000,50' );
		} );

		test( 'throws exception for invalid currency code', function () {
			expect( fn () => new Money( 'US' ) )
				->toThrow( InvalidArgumentException::class, 'Invalid currency code' );
		} );

		test( 'throws exception for empty currency code', function () {
			expect( fn () => new Money( '' ) )
				->toThrow( InvalidArgumentException::class, 'Invalid currency code' );
		} );

		test( 'throws exception for too long currency code', function () {
			expect( fn () => new Money( 'USDX' ) )
				->toThrow( InvalidArgumentException::class, 'Invalid currency code' );
		} );
	} );

	describe( 'display method', function () {
		test( 'displays currency without abbreviation', function () {
			$money = new Money( 'USD', 'en_US' );

			expect( $money->display( 1000 ) )
				->toBe( '$1,000.00' );
		} );

		test( 'displays currency with abbreviation', function () {
			$money = new Money( 'USD', 'en_US' );

			expect( $money->display( 1000, true ) )
				->toBe( '$1K' );
		} );

		test( 'handles small amounts with abbreviation', function () {
			$money = new Money( 'EUR', 'it' );

			$result = $money->display( 123.45, true );
			expect( $result )
				->toContain( '123,45' )
				->toContain( '€' );
		} );
	} );

	describe( 'abbreviated method', function () {
		test( 'returns abbreviated currency format', function () {
			$money = new Money( 'USD', 'en_US' );

			expect( $money->abbreviated( 1000 ) )
				->toBe( '$1K' );
		} );

		test( 'handles decimal amounts correctly', function () {
			$money = new Money( 'USD', 'en_US' );

			expect( $money->abbreviated( 1500 ) )
				->toBe( '$1.5K' );
		} );
	} );

	describe( 'locale-specific formatting', function () {
		test( 'formats Italian locale with comma decimal separator', function () {
			$money = new Money( 'EUR', 'it' );

			$result = $money->abbreviated( 3173.2 );
			expect( $result )
				->toContain( '3,17K' )
				->toContain( '€' );
		} );

		test( 'formats US locale with dot decimal separator', function () {
			$money = new Money( 'USD', 'en_US' );

			expect( $money->abbreviated( 3173.2 ) )
				->toBe( '$3.17K' );
		} );

		test( 'formats German locale with comma decimal separator', function () {
			$money = new Money( 'EUR', 'de_DE' );

			$result = $money->abbreviated( 3173.2 );
			expect( $result )
				->toContain( '3,17K' )
				->toContain( '€' );
		} );

		test( 'formats French locale correctly', function () {
			$money = new Money( 'EUR', 'fr_FR' );

			$result = $money->abbreviated( 1500 );

			expect( $result )
				->toContain( '1,5K' )
				->toContain( '€' );
		} );
	} );

	describe( 'various amount ranges', function () {
		test( 'handles thousands correctly', function () {
			$money = new Money( 'USD', 'en_US' );

			expect( $money->abbreviated( 1000 ) )->toBe( '$1K' );
			expect( $money->abbreviated( 2500 ) )->toBe( '$2.5K' );
			expect( $money->abbreviated( 9999 ) )->toBe( '$10K' );
		} );

		test( 'handles millions correctly', function () {
			$money = new Money( 'USD', 'en_US' );

			expect( $money->abbreviated( 1000000 ) )->toBe( '$1M' );
			expect( $money->abbreviated( 2500000 ) )->toBe( '$2.5M' );
		} );

		test( 'handles billions correctly', function () {
			$money = new Money( 'USD', 'en_US' );

			expect( $money->abbreviated( 1000000000 ) )->toBe( '$1B' );
			expect( $money->abbreviated( 2500000000 ) )->toBe( '$2.5B' );
		} );

		test( 'handles small amounts without abbreviation', function () {
			$money = new Money( 'USD', 'en_US' );

			expect( $money->abbreviated( 999 ) )->toBe( '$999' );
			expect( $money->abbreviated( 123.45 ) )->toBe( '$123.45' );
		} );
	} );

	describe( 'currency symbol positioning', function () {
		test( 'USD places symbol before amount', function () {
			$money = new Money( 'USD', 'en_US' );

			expect( $money->abbreviated( 1000 ) )
				->toStartWith( '$' );
		} );

		test( 'EUR places symbol after amount in Italian locale', function () {
			$money = new Money( 'EUR', 'it' );

			expect( $money->abbreviated( 1000 ) )
				->toContain( '€' );
		} );

		test( 'EUR places symbol after amount in German locale', function () {
			$money = new Money( 'EUR', 'de_DE' );

			expect( $money->abbreviated( 1000 ) )
				->toContain( '€' );
		} );
	} );

	describe( 'edge cases', function () {
		test( 'handles zero amount', function () {
			$money = new Money( 'USD', 'en_US' );

			expect( $money->abbreviated( 0 ) )
				->toBe( '$0' );
		} );

		test( 'handles negative amounts', function () {
			$money = new Money( 'USD', 'en_US' );

			$result = $money->abbreviated( -1000 );
			expect( $result )
				->toContain( '-' )
				->toContain( '1K' );
		} );

		test( 'handles very large amounts', function () {
			$money = new Money( 'USD', 'en_US' );

			expect( $money->abbreviated( 1000000000000 ) )
				->toBe( '$1T' );
		} );
	} );
} );
