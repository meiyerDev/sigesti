<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
	protected $table = 'people';

	protected $fillable = [
		'identity',
		'first_name',
		'last_name',
		'phone',
		'created_at',
		'update_at',
	];

	public function experts()
	{
		return $this->hasMany(Expert::class);
	}

	public function responsables()
	{
		return $this->hasMany(Responsable::class);
	}
}
