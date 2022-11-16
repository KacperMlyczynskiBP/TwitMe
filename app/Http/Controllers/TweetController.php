<?php

namespace App\Http\Controllers;

use App\Http\Requests\tweetRequest;
use App\Http\Services\TweetServices;
use App\Models\Post;

class TweetController extends Controller
{
    public function show($postId){
        $post=Post::findOrFail($postId);
        $comments=Post::where('reply_id', $postId)->get();
        return view('singleTweet', compact('post', 'comments'));
    }

    public function storeTweet(tweetRequest $request){
        (new TweetServices())->storeTweet($request);
        return redirect()->back();
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
