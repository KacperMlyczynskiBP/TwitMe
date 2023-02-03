<?php

namespace App\Http\Controllers;

use App\Http\Requests\tweetRequest;
use App\Http\Services\TweetServices;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class TweetController extends Controller
{
    public function show($postId){
        $post=Post::findOrFail($postId);
        $user=User::findOrFail($post['user_id']);
        $userPath=Auth()->user()->image_path;
        $comments=DB::table('posts')->join('users', 'posts.user_id', '=', 'users.id')->where('reply_id', $postId)->get();
        return view('singleTweet', compact('post', 'comments', 'user', 'userPath'));
    }

    public function storeTweet(tweetRequest $request){
        (new TweetServices())->storeTweet($request);
        return redirect()->route('index');
    }

    public function storeTweetReply(tweetRequest $request){
        (new TweetServices())->storeTweetReply($request);
        return redirect()->back();
    }

    public function likeTweet($postId){
        (new TweetServices())->likeTweet($postId);
        return redirect()->back();
    }
}
