<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 27 May 2019 06:07:42 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ArticleExpert
 * 
 * @property int $id
 * @property int $article_id
 * @property int $expert_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Article $article
 * @property \App\Models\Expert $expert
 *
 * @package App\Models
 */
class ArticleExpert extends Eloquent
{
	protected $casts = [
		'article_id' => 'int',
		'expert_id' => 'int'
	];

	protected $fillable = [
		'article_id',
		'expert_id'
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
