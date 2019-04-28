<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
    	'department',
		'created_at',
		'update_at',
    ];

    public function desktops()
	{
		return $this->hasMany(Desktop::class);
	}

	public function laptops()
	{
		return $this->hasMany(Laptop::class);
	}

	public function printers()
	{
		return $this->hasMany(Printer::class);
	}

	public function others()
	{
		return $this->hasMany(Other::class);
	}
}
