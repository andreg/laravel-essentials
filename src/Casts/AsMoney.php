<?php

namespace Andreg\Essentials\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class AsMoney implements CastsAttributes {

	public function get( $model, string $key, mixed $value, array $attributes ): ?float {
		if ( null === $value ) {
			return null;
		}

		return floatval( number_format( $value / 100, 2, '.', '' ) );
	}

	public function set( $model, string $key, mixed $value, array $attributes ) {
		if ( null === $value ) {
			return null;
		}

		return intval( $value * 100 );
	}

}
