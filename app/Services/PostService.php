<?php

namespace App\Services;

use App\Http\Requests\tweetRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
    public function createPost(array $data){
            $user = Auth()->user();

            $post = new Post();
            $post->body = $data['body'];
            $post->user_id = $user->id;
            $post->image_path = $data['image_path'] ?? NULL;

            if($data['tweetMedia'] && $data['tweetMedia']->isValid()){
                $fileName = $data['tweetMedia']->getClientOriginalName();
                $data['tweetMedia']->move('images', $fileName);
                $post->image_path = $fileName;
            }
            $post->save();

            return $post;
    }
}
