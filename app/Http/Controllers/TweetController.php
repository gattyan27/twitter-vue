<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTweet;
use App\Tweet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class TweetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index(Tweet $tweet)
    {
        $user = auth()->user();
        $tweets = Tweet::with('user')->orderBy('id', 'desc')->get();
        return $tweets;
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
