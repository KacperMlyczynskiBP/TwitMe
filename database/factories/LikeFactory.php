<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $postsId=Post::pluck('id')->toArray();
        $usersId=User::pluck('id')->toArray();

        $uniqueClosure=function() use($usersId, $postsId){
            $userId=$this->faker()->randomElement($usersId);
            $postId=$this->faker()->randomElement($postsId);
           while(Like::where('user_id', $userId)->where('post_id', $postId)->exists()){
               $userId=$this->faker()->randomElement($usersId);
               $postId=$this->faker()->randomElement($postsId);
           };
            return [
                'user_id' => $userId,
                'post_id' => $postId,
            ];
        };
    }
}
