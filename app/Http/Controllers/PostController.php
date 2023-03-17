<?php

namespace App\Http\Controllers;

use App\Http\Requests\tweetRequest;
use App\Models\Blocked;
use App\Models\Post;
use App\Models\Retweet;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
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


    public function listPostLikes($postId){
        $listLikedPostUsers = DB::table('likes')
            ->where('post_id', $postId)
            ->pluck('user_id')
            ->toArray();

        $users = User::whereIn('id', $listLikedPostUsers)->get();
        return view('listPostsLikes', compact('users'));
    }

    public function retweet($postId, $request){
          $id = Auth()->user()->id;
          $retweet = new Retweet();
          $retweet->user_id = $id;
          $retweet->post_id = $postId;
          $retweet->comment = $request->comment ?? NULL;
          $retweet->save();

          $post = Post::findOrFail($postId);
          $post->increment('retweet_count');
    }

    public function storeTweet(tweetRequest $request): RedirectResponse{
        $data = $request->validated();
        $this->postService->createPostData($data);

        return redirect()->back();
    }

    public function storeTweetReply(tweetRequest $request): RedirectResponse{
        $data = $request->validated();

        $this->postService->createPostData($data, $data['post_id']);

        return redirect()->back();
    }



}
