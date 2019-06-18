<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $fillable = [
    	'person_id',
        'created_at',
        'update_at',
    ];

    public function person()
    {
    	return $this->belongsTo(Person::class);
    }

    public function articles()
    {
    	return $this->hasMany(Article::class);
    }
}
