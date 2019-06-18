<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 27 May 2019 06:07:42 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Department
 * 
 * @property int $id
 * @property string $department
 * @property string $firstname_director
 * @property string $lastname_director
 * @property string $phone
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $articles
 * @property \Illuminate\Database\Eloquent\Collection $desktops
 *
 * @package App\Models
 */
class Department extends Eloquent
{
	protected $fillable = [
		'department',
		'firstname_director',
		'lastname_director',
		'phone'
	];

	public function articles()
	{
		return $this->hasMany(\App\Models\Article::class);
	}

	public function desktops()
	{
		return $this->hasMany(\App\Models\Desktop::class);
	}
}
