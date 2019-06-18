<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 13 Jun 2019 06:25:15 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Request
 * 
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $observation
 * @property int $responsable_id
 * @property int $expert_id
 * @property int $article_id
 * 
 * @property \App\Models\Article $article
 * @property \App\Models\Expert $expert
 * @property \App\Models\Responsable $responsable
 *
 * @package App\Models
 */
class Request extends Eloquent
{
	protected $casts = [
		'responsable_id' => 'int',
		'expert_id' => 'int',
		'article_id' => 'int'
	];

	protected $fillable = [
		'observation',
		'responsable_id',
		'expert_id',
		'article_id'
	];

	public function article()
	{
		return $this->belongsTo(\App\Models\Article::class);
	}

	public function expert()
	{
		return $this->belongsTo(\App\Models\Expert::class);
	}

	public function responsable()
	{
		return $this->belongsTo(\App\Models\Responsable::class);
	}
}
