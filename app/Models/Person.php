<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 27 May 2019 06:08:46 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Person
 * 
 * @property int $id
 * @property string $identity
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $experts
 * @property \Illuminate\Database\Eloquent\Collection $responsables
 *
 * @package App\Models
 */
class Person extends Eloquent
{
	protected $fillable = [
		'identity',
		'first_name',
		'last_name',
		'phone'
	];

	public function expert()
	{
		return $this->hasOne(\App\Models\Expert::class);
	}

	public function responsables()
	{
		return $this->hasMany(\App\Models\Responsable::class);
	}
}
