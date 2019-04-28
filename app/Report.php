<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
	protected $fillable = [
		'article_id',
		'maintenance',
		'request',
		'internet',
		'users', 
		'cartucho',
		'description',
		'expert_id',
		'created_at',
		'update_at',
	];

	public function article()
	{
		return $this->belongsTo(Article::class);
	}

	public function desktop()
	{
		return $this->belongsTo(Desktop::class);
	}

	public function expert()
	{
		return $this->belongsTo(Expert::class);
	}
	
}
