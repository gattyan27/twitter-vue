<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'profile_image',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tweets()
    {
        return $this->hasMany('App\Tweet');
    }

    // フォローしているか
    public function follows()
    {
        return $this->belongsToMany('App\User', 'followers', 'user_id', 'follower_id');
    }

    // フォローされているか
    public function followers()
    {
        return $this->belongsToMany('App\User', 'followers', 'follower_id', 'user_id');
    }
}
