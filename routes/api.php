<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// 新規登録
Route::post('/register', 'Auth\RegisterController@register')->name('register');

// ログイン
Route::post('/login', 'Auth\LoginController@login')->name('login');

// ログアウト
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// ログインユーザ
Route::get('/user', function() {
    return Auth::user();
})->name('user');

// ツイート投稿
Route::post('/tweets', 'TweetController@create')->name('tweet.create');

// ツイート一覧
Route::get('/tweets', 'TweetController@index')->name('tweet.index');

// ツイート詳細
Route::get('/tweets/{id}', 'TweetController@show')->name('tweet.show');

// いいね
Route::put('/tweets/{id}/like', 'TweetController@like')->name('tweet.like');

// いいね解除
Route::delete('/tweets/{id}/like', 'TweetController@unlike');