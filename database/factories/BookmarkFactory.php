<?php

namespace Database\Factories;

use App\Models\Bookmark;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bookmark>
 */
class BookmarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        $postIds = Post::pluck('id')->toArray();

        $uniqueClosure = function () use ($userIds, $postIds) {
            $userId = $this->faker->randomElement($userIds);
            $postId = $this->faker->randomElement($postIds);
            while (Bookmark::where('user_id', $userId)->where('post_id', $postId)->exists()) {
                $userId = $this->faker->randomElement($userIds);
                $postId = $this->faker->randomElement($postIds);
            }
            return [
                'user_id' => $userId,
                'post_id' => $postId,
            ];
        };

        return $uniqueClosure();
    }
}
