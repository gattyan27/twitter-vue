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
use phpDocumentor\Reflection\Types\Integer;

class TweetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $user = auth()->user();
        $tweets = Tweet::with(['user', 'likes'])->orderBy('id', 'desc')->get();
        return $tweets;
    }

    public function show(String $id)
    {
        $tweet = Tweet::where('id', $id)->with(['user', 'likes'])->first();
        return $tweet ?? abort(404);

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

    public function like(string $id)
    {
        $tweet = Tweet::where('id', $id)->with('likes')->first();

        if(! $tweet) {
            abort(404);
        }

        $tweet->likes()->detach(Auth::user()->id);
        $tweet->likes()->attach(Auth::user()->id);

        return ["tweet_id" => $id];
    }

    public function unlike(string $id)
    {
        $tweet = Tweet::where('id', $id)->with('likes')->first();

        if(! $tweet) {
            abort(404);
        }

        $tweet->likes()->detach(Auth::user()->id);

        return ["tweet_id" => $id];
    }
}
