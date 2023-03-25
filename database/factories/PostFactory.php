<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'body' => $this->faker->paragraph(1),
            'user_id' => User::pluck('id')->random(),
            'reply_id' => null,
            'retweets_count' => 0,
            'view_counts' => $this->faker->numberBetween($min = 1, $max = 1000),
            'likes_count' => $this->faker->numberBetween($min = 1, $max = 1000),
            'visible' => true,
        ];
    }
}
