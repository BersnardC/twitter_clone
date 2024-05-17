<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Login;

class Home extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $id_user = Auth::id();
        $tweets = Tweet::orderBy('id', 'DESC')->get();
        $users = User::where('id', '!=', $id_user)->get();
        foreach ($tweets as $tweet) {
            $tweet->user = User::where('id', $tweet->id_user)->first();
        }
        $logins = Login::where('id_user', $id_user)->orderBy('date_login', 'DESC')->get();
        return view('home.home', ['tweets' => $tweets, 'users' => $users, 'logins' => $logins]);
    }

    public function save_post(Request $request) {
        $id_user = Auth::id();
        $tweet = new Tweet();
        $tweet->content = $request->content_tweet;
        $tweet->created_at = date('Y-m-d');
        $tweet->id_user = $id_user;
        $saved = $tweet->save();
        $tweet->creacion = date('d-m-Y', strtotime($tweet->created_at));
        $user = User::where('id', $id_user)->first();
        $posting = date('Ymdhis');
        if (!$saved) {
            return response()->json(['code' => 409, 'message' => 'Error al guardar el tweet']);
        } else {
            return response()->json(['code' => 200, 'tweet' => $tweet, 'user' => $user, 'posting' => $posting]);
        }        
    }
    # Functons API
    public function get_tweets()
    {
        $tweets = Tweet::with('user')->orderBy('id', 'DESC')->get();
        return response()->json(['twets' => $tweets]);
    }

    public function save_tweet(Request $request)
    {
        $id_user = 1;
        $tweet = Tweet::create([
            'content' => $request->content_tweet,
            'id_user' => $id_user,
            'created_at' => date('Y-m-d')
        ]);
        return response()->json(['code' => 200, 'tweet' => $tweet]);
    }
}
