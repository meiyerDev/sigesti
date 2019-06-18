<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 27 May 2019 06:07:42 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Cartridge
 * 
 * @property int $id
 * @property string $code
 * @property int $article_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Article $article
 *
 * @package App\Models
 */
class Cartridge extends Eloquent
{
	protected $casts = [
		'article_id' => 'int'
	];

	protected $fillable = [
		'code',
		'article_id'
	];

	public function article()
	{
		return $this->belongsTo(\App\Models\Article::class);
	}
}
