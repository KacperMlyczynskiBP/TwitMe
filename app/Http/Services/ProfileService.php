<?php

namespace App\Http\Services;

use App\Http\Requests\updateUserRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;

class ProfileService
{
   public function getPosts($id){

       $likes=DB::table('posts')
           ->join('users', 'posts.user_id', '=', 'users.id')   /// posts which have the same user_id with users.id
           ->join('likes', 'posts.user_id', '=', 'likes.user_id') // users which have the same users.id as likes.user_id
           ->where('posts.user_id', $id)->get()->first();

       $posts=array();
       foreach($likes as $like){
           $posts[]=Post::where(['id'=>$like->post_id])->get()->first();
       }
       return $posts;
   }
   public function getUserTweets($id){
//       $test=Post::where('reply_id',$id)->get();

       $userTweets=DB::table('users')->join('posts', 'users.id', '=', 'posts.user_id')
           ->where('user_id', $id)
           ->orWhere('reply_id', $id)
           ->get()->all();
//       dd($userTweets);
//
//
//       $userTweets=DB::table('posts')
//           ->join('users', 'posts.user_id', '=', 'users.id')
//           ->where('user_id', $id)
//           ->orWhere('reply_id', $id)
//           ->get()->all();
//       dd($userTweets);
////
////       $repliesToUser=DB::table('posts')->join('users', 'posts.user_id', '=', 'users.id')
////           ->where('')
////           ->get();
//       ;
////       $repliesId=array();
////       $postId=array();
////       foreach($test as $t) {
////           $repliesId[]=$t->reply_id;
////           $postId[]=$t->id;
////       }
////       $repliesToUser=DB::table('posts')->whereIn('reply_id', $postId)->get();
////       $repliesToUser=Post::whereIn('reply_id', $postId)->get();
////       $tweetsReplies=Post::whereIn('id', $repliesId)->get();
////       $posts=DB::table('posts')->join('users', 'posts.user_id', '=', 'users.id')->whereIn('user_id', Auth()->user()->id)->get();
//       $userTweets=$test->concat($tweets);
       return $userTweets;
   }

   public function getFollowers($id,$user_id){
           $followers=DB::table('followers')->where($user_id, $id)->get();
           $array=array();
           if($user_id == 'user_id'){
               foreach($followers as $follower){
                   $array[]=$follower->follower_user_id;
               }
           }else{
               foreach($followers as $follower){
                   $array[]=$follower->user_id;
               }
           }
           $followers=User::WhereIn('id', $array)->get();
           return $followers;
   }

   public function updateUser(UpdateUserRequest $request){
       $file=$request->file('tweetMedia');
       $user=Auth()->user();
       if($file === NULL){
           $date_of_birth=$request['date_of_birth'];
           if($request['date_of_birth' === NULL]){
               $date_of_birth=$user['date_of_birth'];
           }
           $user=User::findOrFail(Auth()->user()->id);
           $user->update([
                   'bio'=>$request['bio'], 'location'=>$request['location'],
                   'username'=>$request['username'], 'date_of_birth'=>$date_of_birth,
                   'user_image_path'=>NULL
               ]);
           return $user;
       } else{
           $filePath=$file->getClientOriginalName();
           $file->move('images' ,$filePath);
           $date_of_birth=$request['date_of_birth'];
           if($request['date_of_birth' === NULL]){
               $date_of_birth=$user['date_of_birth'];
           }
           $user=User::findOrFail(Auth()->user()->id);
           $user->update([
               'bio'=>$request['bio'], 'location'=>$request['location'],
               'username'=>$request['username'], 'date_of_birth'=>$date_of_birth,
               'user_image_path'=>'/images/' . $filePath
           ]);
           return $user;
       }
   }
}
