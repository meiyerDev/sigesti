<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 27 May 2019 06:09:00 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Report
 * 
 * @property int $id
 * @property int $article_id
 * @property string $maintenance
 * @property string $request
 * @property string $internet
 * @property string $users
 * @property string $cartucho
 * @property string $description
 * @property int $expert_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Article $article
 * @property \App\Models\Expert $expert
 *
 * @package App\Models
 */
class Report extends Eloquent
{
	protected $casts = [
		'article_id' => 'int',
		'expert_id' => 'int'
	];

	protected $fillable = [
		'article_id',
		'maintenance',
		'request',
		'internet',
		'users',
		'cartucho',
		'description',
		'expert_id',
		'confirmed'
	];

	public function article()
	{
		return $this->belongsTo(\App\Models\Article::class);
	}

	public function expert()
	{
		return $this->belongsTo(\App\Models\Expert::class);
	}
}
