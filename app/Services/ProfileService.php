<?php

namespace App\Services;

use App\Helpers\GetBlockedUsersRealtion;
use App\Helpers\PostHelper;
use App\Http\Requests\updateUserRequest;
use App\Models\Blocked;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProfileService
{
    public function getUserById(int $id): User{
        return User::findOrFail($id);
    }

    public function getUserTweetsById(int $id): Collection{
        $userTweets=Post::with('user')
            ->where('posts.user_id', $id)
            ->get();

        $userTweets=PostHelper::addUserImageToPost($userTweets);

        return $userTweets;
    }


    public function getLikedPostsById(int $id): Collection{
        $posts = Post::where('user_id', $id)->pluck('id')->toArray();
        $likedPosts = DB::table('likes')
            ->where(function ($query) use ($id, $posts) {
                $query->where('user_id', $id)
                    ->orWhereIn('post_id', $posts);
            })
            ->get();

        $posts = Post::with('user')
            ->whereIn('id', $likedPosts->pluck('post_id')->unique())
            ->get();

        $posts = PostHelper::addUserImageToPost($posts);

        return $posts;
    }

    public function getUserTweetsRepliesById(int $id): Collection{
        $userTweets=Post::where('user_id', $id)
            ->orWhereIn('reply_id', function($query) use ($id){
                $query->select('id')
                    ->from('posts')
                    ->where('user_id', $id);
            })
            ->get();

        $userTweets=PostHelper::addUserImageToPost($userTweets);

        return $userTweets;
    }

    public function getUserMediaTweetsById(int $id): Collection{
        $tweets=Post::with('user')
            ->where('posts.user_id', $id)
            ->where('image_path', '!=', 'NULL')

            ->get();

        $tweets=PostHelper::addUserImageToPost($tweets);

        return $tweets;
    }

   public function getFollowers(int $id, string $user_id): Collection{
       $user=User::findOrFail($id);

       $followers = ($user_id == 'user_id') ? $user->followers()->pluck('user_id') : $user->following()->pluck('follower_user_id');

       $users=User::select(['user_image_path','username','id'])
               ->WhereIn('id', $followers)
               ->get();

       return $users;
   }

   public function updateUser(UpdateUserRequest $request){
       $file=$request->file('tweetMedia');
       $user=Auth()->user();

       $imagePath = $file ? '/images/' . $file->getClientOriginalName() : 'https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png';
       $date_of_birth = $request['date_of_birth'] ?? $user->date_of_birth;

       if($user->dob_changes > 3){
           return redirect()->back()->withErrors('date of birth changes', 'You exceeded changes of your birth');
       }

       if($date_of_birth !== $request['date_of_birth']){
           $user->dob_changes++;
       }

       $user->update([
           'bio'=>$request['bio'], 'location'=>$request['location'],
           'username'=>$request['username'],
           'user_image_path'=> $imagePath,
           'date_of_birth'=> $date_of_birth,
       ]);

   }
}
