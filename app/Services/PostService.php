<?php

namespace App\Services;

use App\Helpers\PostHelper;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Collection;


class PostService
{
    public function getUserById(int $id): User{
        return User::findOrFail($id);
    }

    public function getPostById(int $id): Post{
        return Post::findOrFail($id);
    }

    public function getCommentsById(int $id): Collection{
             $comments=Post::with('user')
            ->where('reply_id', $id)
            ->get();

        $comments=PostHelper::addUserImageToPost($comments);

        return $comments;
    }

    public function createPostData(array $data, int $reply_id = NULL): void {
            $user = Auth()->user();

            $post = new Post();
            $post->body = $data['body'];
            $post->user_id = $user->id;
            $post->reply_id = $reply_id;
            $post->image_path = $data['image_path'] ?? NULL;


        if(($data['tweetMedia'] ?? NULL) && $data['tweetMedia']->isValid())
            {
                $fileName = $data['tweetMedia']->getClientOriginalName();
                $data['tweetMedia']->move('images', $fileName);
                $post->image_path = $fileName;
            }

            $post->save();
    }

    public function likeTweet(int $postId):void {
        $id=Auth()->user()->id;
        $user=User::findOrFail($id);

        $like=$user->likes()
            ->where('post_id', $postId)
            ->first();

        if(!$like){
            $user->likes()->attach($postId);
        }else{
            $user->likes()->detach($postId);
        }
    }
}
