<?php

namespace Database\Factories;

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
            'body'=>fake()->text(),
            'user_id'=> rand(100, 200),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
            'reply_id'=> rand(100, 200)
        ];
    }
}
