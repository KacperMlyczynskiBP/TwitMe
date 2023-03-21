<?php

namespace App\Http\Controllers;

use App\Http\Requests\tweetRequest;
use App\Models\Notification;
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

    public function likeTweet(int $postId, int $userId): RedirectResponse{
        $this->postService->likeTweet($postId, $userId);

        return redirect()->back();
    }


    public function listPostLikes($postId): View{
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

        try{
            $data = $request->validated();
            $this->postService->createPostData($data);
            return redirect()->back();
        }catch (\Exception $exception){
            return redirect()->back()->with('error', 'There is an error' . $exception->getMessage());
        }

    }

    public function storeTweetReply(tweetRequest $request): RedirectResponse{
        $data = $request->validated();

        $this->postService->createPostData($data, $request['post_id']);

        $user = User::findOrFail($request->user_id);
        $loggedUser = Auth()->user();

        if($loggedUser->blue_verified == 1 && $user->id !== Auth()->user()->id){
            $notification = new Notification();
            $notification->sender_id = Auth()->user()->id;
            $notification->receiver_id = $user->id;
            $notification->type = 'App\Models\Post';
            $notification->from_verified = true;
            $notification->comment = ' Replied to your post';
            $notification->save();
        } elseif($user->id !== Auth()->user()->id){
            $notification = new Notification();
            $notification->sender_id = Auth()->user()->id;
            $notification->receiver_id = $user->id;
            $notification->type = 'App\Models\Post';
            $notification->comment = ' Replied to your post';
            $notification->save();
        }

        return redirect()->back();
    }



}
