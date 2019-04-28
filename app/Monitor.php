<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
	protected $fillable = [
		'article_id',
		'inche',
		'created_at',
		'update_at',
	];

	public function article()
	{
		return $this->belongsTo(Article::class);
	}

	public function desktop()
	{
		return $this->hasOne(Desktop::class);
	}
}
