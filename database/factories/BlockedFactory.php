<?php

namespace Database\Factories;

use App\Models\Blocked;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blocked>
 */
class BlockedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blocked::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        $uniqueClosure = function () use ($userIds) {
            $userId = $this->faker->randomElement($userIds);
            $blockedUserId = $this->faker->randomElement($userIds);
            while (Blocked::where('user_id', $userId)->where('blocked_user_id', $blockedUserId)->exists()) {
                $userId = $this->faker->randomElement($userIds);
                $blockedUserId = $this->faker->randomElement($userIds);
            }
            return [
                'user_id' => $userId,
                'blocked_user_id' => $blockedUserId,
            ];
        };
        return $uniqueClosure();
    }
}
