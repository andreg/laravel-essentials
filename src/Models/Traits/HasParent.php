<?php

namespace Andreg\LaravelEssentials\Models\Traits;

use Illuminate\Database\Eloquent\Model;

// @phpstan-ignore-next-line
trait HasParent {

	private string $pathField         = 'path';
	private string $relationshipField = 'parent_id';

	/**
	 * Get the parent dictionary entry.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
		return $this->belongsTo( static::class, $this->relationshipField );
	}

	/**
	 * Get the children dictionary entries.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function children(): \Illuminate\Database\Eloquent\Relations\HasMany {
		return $this->hasMany( static::class, $this->relationshipField );
	}

	protected static function bootHasParent() {
		static::saved( function ( Model $model ) {
			$model->savePath();
		} );
	}

	public function determinePath(): string {
		if ( null === $this->parent ) {
			return (string) $this->getKey();
		}

		$path         = (string) $this->getKey();
		$currentEntry = $this;

		while ( null !== $currentEntry->parent ) {
			$path         = (string) $currentEntry->parent->getKey() . ' > ' . $path;
			$currentEntry = $currentEntry->parent;
		}

		return $path;
	}

	public function savePath(): void {
		$this->{$this->pathField} = $this->determinePath();
		$this->saveQuietly();

		$this->children()->each( function ( Model $child ) {
			$child->save();
		} );
	}

}
