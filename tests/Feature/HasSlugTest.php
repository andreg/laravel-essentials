<?php

use Andreg\LaravelEssentials\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;

class FakeModelWithSlug extends Model {
	use HasSlug;

	protected $fillable = [ 'name', 'slug' ];

}

describe( 'HasSlug', function () {
	describe( 'generateSlug method', function () {
		test( 'generates slug from name when slug is empty', function () {
			$model       = new FakeModelWithSlug();
			$model->name = 'This Is A Test Title';

			$model->generateSlug( 'slug', 'name' );

			expect( $model->slug )->toBe( 'this-is-a-test-title' );
		} );

		test( 'does not override existing slug', function () {
			$model       = new FakeModelWithSlug();
			$model->name = 'This Is A Test Title';
			$model->slug = 'existing-slug';

			$model->generateSlug( 'slug', 'name' );

			expect( $model->slug )->toBe( 'existing-slug' );
		} );
	} );
} );
