<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 27 May 2019 06:07:42 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Article
 * 
 * @property int $id
 * @property string $serial
 * @property string $model
 * @property string $brand
 * @property string $type
 * @property string $name_otro
 * @property string $observation
 * @property int $department_id
 * @property int $responsable_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Department $department
 * @property \App\Models\Responsable $responsable
 * @property \Illuminate\Database\Eloquent\Collection $experts
 * @property \Illuminate\Database\Eloquent\Collection $cartridges
 * @property \Illuminate\Database\Eloquent\Collection $cpuses
 * @property \Illuminate\Database\Eloquent\Collection $monitors
 * @property \Illuminate\Database\Eloquent\Collection $reports
 *
 * @package App\Models
 */
class Article extends Eloquent
{
	protected $casts = [
		'department_id' => 'int',
		'responsable_id' => 'int'
	];

	protected $fillable = [
		'serial',
		'model',
		'brand',
		'type',
		'name_otro',
		'observation',
		'department_id',
		'responsable_id'
	];

	public function department()
	{
		return $this->belongsTo(\App\Models\Department::class);
	}

	public function responsable()
	{
		return $this->belongsTo(\App\Models\Responsable::class);
	}

	public function experts()
	{
		return $this->belongsToMany(\App\Models\Expert::class, 'article_experts')
					->withPivot('id')
					->withTimestamps();
	}

	public function cartridges()
	{
		return $this->hasMany(\App\Models\Cartridge::class);
	}

	public function cpus()
	{
		return $this->hasOne(\App\Models\Cpus::class);
	}

	public function monitor()
	{
		return $this->hasOne(\App\Models\Monitor::class);
	}

	public function report()
	{
		return $this->hasOne(\App\Models\Report::class);
	}

	public function request()
	{
		return $this->hasOne(\App\Models\Request::class);
	}
}
