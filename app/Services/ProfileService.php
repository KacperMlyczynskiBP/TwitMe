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
        $blockedUsers = Blocked::where('user_id', auth()->user()->id)
            ->orWhere('blocked_user_id', Auth()->user()->id)
            ->pluck('blocked_user_id')
            ->all();
         dd($blockedUsers);
        $blockedUsers = GetBlockedUsersRealtion::getBlockedUserRelation($id);
        $likedPosts=DB::table('likes')
            ->where('user_id', $id)
            ->whereNotIn('user_id', $blockedUsers)
            ->pluck('post_id');


        $posts = Post::with('user')
            ->whereIn('id', $likedPosts)
            ->whereNotIn('user_id', $blockedUsers)
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

   public function updateUser(UpdateUserRequest $request): void{
       $file=$request->file('tweetMedia');
       $user=Auth()->user();

       $imagePath = $file ? '/images/' . $file->getClientOriginalName() : 'https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png';
       $date_of_birth = $request['date_of_birth'] ?? $user->date_of_birth;

       $user->update([
           'bio'=>$request['bio'], 'location'=>$request['location'],
           'username'=>$request['username'],
           'user_image_path'=> $imagePath,
           'date_of_birth'=> $date_of_birth,
       ]);

   }
}
