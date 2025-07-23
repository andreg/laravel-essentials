<?php

test( 'that data casted to money saves to integer', function () {
	$amount = 123.45;
	$cast   = new \Andreg\Essentials\Casts\AsMoney();

	expect( $cast->set( null, 'amount', $amount, [] ) )->toBe( 12345 );
} );

test( 'that data saved as money casts to float when retrieved', function () {
	$amount = 12345;
	$cast   = new \Andreg\Essentials\Casts\AsMoney();

	expect( $cast->get( null, 'amount', $amount, [] ) )->toBe( 123.45 );
} );
