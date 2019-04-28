<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $fillable = [
		'serial',
		'model',
		'brand',
		'responsable_id',
		'type',
		'name_otro',
		'department_id',
		'observation',
		'created_at',
		'update_at',
	];

	public function report()
	{
		return $this->hasOne(Report::class);
	}

	public function monitor()
	{
		return $this->hasOne(Monitor::class);
	}

	public function cpu()
	{
		return $this->hasOne(Cpu::class);
	}

	public function department()
	{
		return $this->belongsTo(Department::class);
	}

	public function responsable()
	{
		return $this->belongsTo(Responsable::class);
	}
}
