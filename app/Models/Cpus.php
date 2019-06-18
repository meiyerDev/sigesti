<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 27 May 2019 06:07:42 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Cpus
 * 
 * @property int $id
 * @property string $ram
 * @property string $processor
 * @property string $so
 * @property string $memory_video
 * @property int $article_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Article $article
 * @property \Illuminate\Database\Eloquent\Collection $desktops
 *
 * @package App\Models
 */
class Cpus extends Eloquent
{
	protected $table = 'cpus';

	protected $casts = [
		'article_id' => 'int'
	];

	protected $fillable = [
		'ram',
		'processor',
		'so',
		'memory_video',
		'article_id'
	];

	public function article()
	{
		return $this->belongsTo(\App\Models\Article::class);
	}

	public function desktop()
	{
		return $this->hasOne(\App\Models\Desktop::class, 'cpu_id');
	}
}
