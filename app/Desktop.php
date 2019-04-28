<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desktop extends Model
{
	protected $fillable = [
		'cpu_id',
		'monitor_id',
		'department_id',
		'created_at',
		'update_at',
	];

	public function department()
	{
		return $this->belongsTo(Department::class);
	}

	public function monitor()
	{
		return $this->belongsTo(Monitor::class);
	}

	public function cpu()
	{
		return $this->belongsTo(Cpu::class);
	}

	public function reports()
	{
		return $this->hasMany(Report::class);
	}
}
