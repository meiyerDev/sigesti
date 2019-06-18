<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 27 May 2019 06:09:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Responsable
 * 
 * @property int $id
 * @property int $person_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Person $person
 * @property \Illuminate\Database\Eloquent\Collection $articles
 *
 * @package App\Models
 */
class Responsable extends Eloquent
{
	protected $casts = [
		'person_id' => 'int'
	];

	protected $fillable = [
		'person_id'
	];

	public function person()
	{
		return $this->belongsTo(\App\Models\Person::class);
	}

	public function articles()
	{
		return $this->hasMany(\App\Models\Article::class);
	}
}
