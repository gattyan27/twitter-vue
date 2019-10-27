<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = [
        'text'
    ];

    protected $visible = [
        'id', 'user',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function favorites()
    {
        return $this->hasMany('App\Favorite');
    }

}
