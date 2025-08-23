<?php

namespace Tests\Feature\Mocks;

use Andreg\LaravelEssentials\Models\Traits\HasParent;
use Illuminate\Database\Eloquent\Model;

class FakeModelWithParent extends Model {
	use HasParent;

	protected $fillable = [ 'id', 'parent_id', 'path' ];

	public $parent;
	public $id;

	public function getKey() {
		return $this->id;
	}

}
