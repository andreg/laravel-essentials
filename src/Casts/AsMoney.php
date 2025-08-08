<?php

declare( strict_types=1 );

namespace Andreg\Essentials\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

/**
 * @implements CastsAttributes<float, int>
 */
class AsMoney implements CastsAttributes {

	public function get( Model $model, string $key, mixed $value, array $attributes ): ?float {
		if ( null === $value ) {
			return null;
		}

		return floatval( number_format( $value / 100, 2, '.', '' ) );
	}

	public function set( Model $model, string $key, mixed $value, array $attributes ) {
		if ( null === $value ) {
			return null;
		}

		return intval( $value * 100 );
	}

}
