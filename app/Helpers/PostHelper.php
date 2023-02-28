<?php

namespace App\Http\Helpers;

class PostHelper
{
    public function addUserImageToPost($posts){
        return  $posts->filter(function ($post){
            return $post->user;
        })
            ->map(function($post) {
                $post['user_image_path'] = $post->user->user_image_path;
                $post['image_path'] = $post->image_path;
                return $post;
            });
    }
}
