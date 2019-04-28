<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartridge extends Model
{
	protected $fillable = [
		'code',
		'model',
		'marca',
		'article_id',
		'created_at',
		'update_at',
	];

	public function printer()
	{
		return $this->belongsTo(Printer::class);
	}

}