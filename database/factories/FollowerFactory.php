<?php

namespace Database\Factories;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Follower>
 */
class FollowerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        $uniqueClosure = function () use ($userIds) {
            $userId = $this->faker->randomElement($userIds);
            $followerUserId = $this->faker->randomElement($userIds);
            while (Follower::where('user_id', $userId)->where('follower_user_id', $followerUserId)->exists()) {
                $userId = $this->faker->randomElement($userIds);
                $followerUserId = $this->faker->randomElement($userIds);
            }
            return [
                'user_id' => $userId,
                'follower_user_id' => $followerUserId,
            ];
        };
        return $uniqueClosure();
    }
}
