<?php

namespace App\Http\Controllers;

use App\Http\Requests\tweetRequest;
use App\Services\PostService;

class PostController extends Controller
{

    protected $postService;

    public function __construct(PostService $postService){
        $this->postService = $postService;
    }

    public function storeTweet(tweetRequest $request){
        $data = $request->all();
        $this->postService->createPostData($data);
        return redirect()->back();
    }

    public function storeTweetReply(tweetRequest $request){
        $data = $request->all();
        $this->postService->createPostData($data, $data['post_id']);
        return redirect()->back();
    }



}
