<?php

namespace Andreg\LaravelEssentials\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

// @phpstan-ignore-next-line
trait HasSlug {

	private string $slugField  = 'slug';
	private string $titleField = 'name';

	protected static function bootHasSlug() {
		static::saving( function ( Model $model ) {
			$model->generateSlug(
				slugField: $model->slugField,
				titleField: $model->titleField
			);
		} );
	}

	public function generateSlug( string $slugField, string $titleField ) {
		if ( ! $this->{$slugField} ) {
			$this->{$slugField} = Str::slug( $this->{$titleField} );
		}
	}

}
