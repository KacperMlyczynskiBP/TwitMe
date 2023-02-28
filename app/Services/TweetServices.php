<?php

namespace App\Http\Services;

use App\Http\Requests\tweetRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TweetServices
{


    public function storeTweet($request)
    {
        $input = $request->only('body', 'tweetMedia', 'post_id');
        $file = $request->file('tweetMedia');
        if (!$file) {
            Post::create(['body' => $input['body'], 'user_id' => Auth()->user()->id]);
        } else{
            $fileName = $file->getClientOriginalName();
            $file->move('images', $fileName);
            Post::create(['body' => $input['body'], 'user_id' => Auth()->user()->id, 'image_path' => $fileName]);
        }
    }

    public function storeTweetReply(tweetRequest $request): Post {
        $input = $request->only('body', 'tweetMedia', 'post_id');
        $request->all();
        dd($request->all());
        if ($input) {
            $file = $request->file('tweetMedia');
            if (!$file) {
               $post = Post::create(['body' => $input['body'], 'user_id' => Auth()->user()->id, 'reply_id' => $input['post_id']]);

                return redirect()->back()->with($post);
            }
            $fileName = $file->getClientOriginalName();
            $file->move('images', $fileName);
            $post = Post::create(['body' => $input['body'], 'user_id' => Auth()->user()->id, 'image_path' => $fileName, 'reply_id' => $input['post_id']]);
            return $post;
    }
        }


        public function likeTweet($postId){
            $id=Auth()->user()->id;
            $user=User::findOrFail($id);

          $like=$user->likes()->where('post_id', $postId)->first();

          if(!$like){
              $user->likes()->attach($postId);
          }else{
              $user->likes()->detach($postId);
          }
            return redirect()->back();
    }


}
