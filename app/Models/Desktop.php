<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 27 May 2019 06:07:42 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Desktop
 * 
 * @property int $id
 * @property int $cpu_id
 * @property int $monitor_id
 * @property int $department_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Cpus $cpus
 * @property \App\Models\Department $department
 * @property \App\Models\Monitor $monitor
 *
 * @package App\Models
 */
class Desktop extends Eloquent
{
	protected $casts = [
		'cpu_id' => 'int',
		'monitor_id' => 'int',
		'department_id' => 'int'
	];

	protected $fillable = [
		'cpu_id',
		'monitor_id',
		'department_id'
	];

	public function cpus()
	{
		return $this->belongsTo(\App\Models\Cpus::class, 'cpu_id');
	}

	public function department()
	{
		return $this->belongsTo(\App\Models\Department::class);
	}

	public function monitor()
	{
		return $this->belongsTo(\App\Models\Monitor::class);
	}
}
