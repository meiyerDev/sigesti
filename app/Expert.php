<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
	protected $fillable = [
		'person_id',
		'user_id',	
		'created_at',
		'update_at',
	];

	public function person()
	{
		return $this->belongsTo(Person::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function reports()
	{
		return $this->hasMany(Report::class);
	}
}
