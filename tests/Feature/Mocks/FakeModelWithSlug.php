<?php

namespace Tests\Feature\Mocks;

use Andreg\LaravelEssentials\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;

class FakeModelWithSlug extends Model {
	use HasSlug;

	protected $fillable = [ 'name', 'slug' ];

}
