<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cpu extends Model
{
	protected $fillable = [
		'ram',
		'processor',
		'so',
		'memory_video',
		'article_id',
		'created_at',
		'update_at',
	];

	public function desktop()
	{
		return $this->hasMany(Desktop::class);
	}

	public function article()
	{
		return $this->belongsTo(Article::class);
	}

}
