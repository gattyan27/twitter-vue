<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTweet;
use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class TweetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(StoreTweet $request)
    {
        $tweet = new Tweet();
        $user = Auth::user();

        $tweet->user_id = $user->id;
        $tweet->text = $request['text'];

        Auth::user()->tweets()->save($tweet);

        return response($tweet, 201);
    }
}
