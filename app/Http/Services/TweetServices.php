<?php

namespace App\Http\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

    public function storeTweetReply($request){
        $input = $request->only('body', 'tweetMedia', 'post_id');
        if ($input) {
            $file = $request->file('tweetMedia');
            if (!$file) {
                Post::create(['body' => $input['body'], 'user_id' => Auth()->user()->id, 'reply_id' => $input['post_id']]);
                return redirect()->back();
            }
            $fileName = $file->getClientOriginalName();
            $file->move('images', $fileName);
            Post::create(['body' => $input['body'], 'user_id' => Auth()->user()->id, 'image_path' => $fileName, 'reply_id' => $input['post_id']]);
    }
        }


        public function likeTweet($postId){
            $user=User::findOrFail(Auth()->user()->id);
            $likes=DB::table('likes')
                ->where('post_id', $postId)
                ->get()
                ->first();

            if(!$likes){
                $post=$user->likeable()->attach($postId);
                return redirect()->back();
            }
            elseif(!$likes->post_id){
                $post=$user->likeable()->attach($postId);
                return redirect()->back();
            } else{
                $post=$user->likeable()->detach($postId);
                return redirect()->back();
            }
        }
}
