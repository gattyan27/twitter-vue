<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth; 

class Tweet extends Model
{
    protected $fillable = [
        'text'
    ];

    protected $visible = [
        'id', 'user', 'user_id', 'text', self::CREATED_AT, 'likes_count', 'liked_by_user'
    ];

    protected $appends = [
        'likes_count', 'liked_by_user'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likes()
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes->count();
    }

    public function getLikedByUserAttribute()
    {
        if(Auth::guest()) {
            return false;
        }

        return $this->likes->contains(function ($user) {
            return $user->id === Auth::user()->id;
        });
    }

}
