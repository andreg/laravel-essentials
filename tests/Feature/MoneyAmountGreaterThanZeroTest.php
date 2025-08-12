<?php

use Andreg\LaravelEssentials\Rules\MoneyAmountGreaterThanZero;

describe( 'MoneyAmountGreaterThanZero', function () {
	it( 'passes for values greater than zero', function () {
		$rule       = new MoneyAmountGreaterThanZero();
		$failCalled = false;
		$rule->validate( 'amount', 10, function () use ( &$failCalled ) {
			$failCalled = true;
		} );
		expect( $failCalled )->toBeFalse();
	} );

	it( 'fails for zero', function () {
		$rule       = new MoneyAmountGreaterThanZero();
		$failCalled = false;
		$rule->validate( 'amount', 0, function () use ( &$failCalled ) {
			$failCalled = true;
		} );
		expect( $failCalled )->toBeTrue();
	} );

	it( 'fails for negative values', function () {
		$rule       = new MoneyAmountGreaterThanZero();
		$failCalled = false;
		$rule->validate( 'amount', -5, function () use ( &$failCalled ) {
			$failCalled = true;
		} );
		expect( $failCalled )->toBeTrue();
	} );

	it( 'passes for string values greater than zero', function () {
		$rule       = new MoneyAmountGreaterThanZero();
		$failCalled = false;
		$rule->validate( 'amount', '100.50', function () use ( &$failCalled ) {
			$failCalled = true;
		} );
		expect( $failCalled )->toBeFalse();
	} );

	it( 'fails for string zero', function () {
		$rule       = new MoneyAmountGreaterThanZero();
		$failCalled = false;
		$rule->validate( 'amount', '0', function () use ( &$failCalled ) {
			$failCalled = true;
		} );
		expect( $failCalled )->toBeTrue();
	} );

	it( 'fails for string negative values', function () {
		$rule       = new MoneyAmountGreaterThanZero();
		$failCalled = false;
		$rule->validate( 'amount', '-1', function () use ( &$failCalled ) {
			$failCalled = true;
		} );
		expect( $failCalled )->toBeTrue();
	} );
} );
