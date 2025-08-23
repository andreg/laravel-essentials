<?php

use Tests\Feature\Mocks\FakeModelWithParent;

describe( 'HasParent', function () {
	describe( 'determinePath method', function () {
		test( 'returns model key when no parent exists', function () {
			$model     = new FakeModelWithParent();
			$model->id = 5;

			$path = $model->determinePath();

			expect( $path )->toBe( '5' );
		} );

		test( 'returns single level path when one parent exists', function () {
			$parent     = new FakeModelWithParent();
			$parent->id = 1;

			$child         = new FakeModelWithParent();
			$child->id     = 2;
			$child->parent = $parent;

			$path = $child->determinePath();

			expect( $path )->toBe( '1 > 2' );
		} );

		test( 'returns multi-level path when multiple parents exist', function () {
			$grandparent     = new FakeModelWithParent();
			$grandparent->id = 1;

			$parent         = new FakeModelWithParent();
			$parent->id     = 2;
			$parent->parent = $grandparent;

			$child         = new FakeModelWithParent();
			$child->id     = 3;
			$child->parent = $parent;

			$path = $child->determinePath();

			expect( $path )->toBe( '1 > 2 > 3' );
		} );

		test( 'works with string keys', function () {
			$parent     = new FakeModelWithParent();
			$parent->id = 'parent-key';

			$child         = new FakeModelWithParent();
			$child->id     = 'child-key';
			$child->parent = $parent;

			$path = $child->determinePath();

			expect( $path )->toBe( 'parent-key > child-key' );
		} );

		test( 'works with numeric string keys', function () {
			$parent     = new FakeModelWithParent();
			$parent->id = '10';

			$child         = new FakeModelWithParent();
			$child->id     = '20';
			$child->parent = $parent;

			$path = $child->determinePath();

			expect( $path )->toBe( '10 > 20' );
		} );
	} );
} );
