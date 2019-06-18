<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 27 May 2019 06:07:42 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Monitor
 * 
 * @property int $id
 * @property int $article_id
 * @property int $inche
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Article $article
 * @property \Illuminate\Database\Eloquent\Collection $desktops
 *
 * @package App\Models
 */
class Monitor extends Eloquent
{
	protected $casts = [
		'article_id' => 'int',
		'inche' => 'int'
	];

	protected $fillable = [
		'article_id',
		'inche'
	];

	public function article()
	{
		return $this->belongsTo(\App\Models\Article::class);
	}

	public function desktops()
	{
		return $this->hasMany(\App\Models\Desktop::class);
	}
}
