<?php

namespace App\Http\Services;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class ProfileService
{
   public function getPosts(){
       $likes=DB::table('likes')->join('users', 'likes.user_id', '=', 'users.id')->where('users.id', Auth()->user()->id)->get()->all();
       $posts=array();
       foreach($likes as $like){
           $posts[]=Post::where(['id'=>$like->post_id])->get()->first();
       }
       return $posts;
   }
}
