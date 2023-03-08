<?php

namespace App\Http\Controllers;

use App\Http\Requests\tweetRequest;
use App\Models\Blocked;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{

    protected $postService;

    public function __construct(PostService $postService){
        $this->postService = $postService;
    }

    public function show(int $postId): View{
        $post = $this->postService->getPostById($postId);
        $user = $this->postService->getUserById($post['user_id']);
        $userPath=Auth()->user()->user_image_path;

        $comments = $this->postService->getCommentsById($postId);

        return view('singleTweet', compact('post', 'comments', 'user', 'userPath'));
    }

    public function likeTweet(int $postId): RedirectResponse{
        $this->postService->likeTweet($postId);

        return redirect()->back();
    }

    public function storeTweet(tweetRequest $request): RedirectResponse{
        $data = $request->validated();
        $this->postService->createPostData($data);

        return redirect()->back();
    }

    public function storeTweetReply(tweetRequest $request): RedirectResponse{
        $data = $request->validated();

        $blockedUsers = Blocked::where(['user_id'=>Auth()->user()->id, 'blocked_user_id'=> $user->id])->get();

        $this->postService->createPostData($data, $data['post_id']);

        return redirect()->back();
    }



}
