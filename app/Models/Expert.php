<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 27 May 2019 06:07:42 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Expert
 * 
 * @property int $id
 * @property int $person_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Person $person
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $articles
 * @property \Illuminate\Database\Eloquent\Collection $reports
 *
 * @package App\Models
 */
class Expert extends Eloquent
{
	protected $casts = [
		'person_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'person_id',
		'user_id'
	];

	public function person()
	{
		return $this->belongsTo(\App\Models\Person::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}

	public function articles()
	{
		return $this->belongsToMany(\App\Models\Article::class, 'article_experts')
					->withPivot('id')
					->withTimestamps();
	}

	public function reports()
	{
		return $this->hasMany(\App\Models\Report::class);
	}

	public function request()
	{
		return $this->hasMany(\App\Models\Request::class);
	}
}