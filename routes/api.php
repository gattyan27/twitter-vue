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