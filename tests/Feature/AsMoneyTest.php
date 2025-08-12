<?php

use Illuminate\Database\Eloquent\Model;

class FakeModel extends Model {

}

describe( 'AsMoney', function () {
	describe( 'set', function () {
		test( 'data casted to money saves to integer', function () {
			$amount = 123.45;
			$cast   = new \Andreg\LaravelEssentials\Casts\AsMoney();

			expect( $cast->set( new FakeModel(), 'amount', $amount, [] ) )->toBe( 12345 );
		} );
	} );

	describe( 'get', function () {
		test( 'data saved as money casts to float when retrieved', function () {
			$amount = 12345;
			$cast   = new \Andreg\LaravelEssentials\Casts\AsMoney();

			expect( $cast->get( new FakeModel(), 'amount', $amount, [] ) )->toBe( 123.45 );
		} );
	} );
} );
