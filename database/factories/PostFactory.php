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
            'body'=>fake()->text(5),
            'user_id'=> rand(1, 3),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
            'reply_id'=> NULL
        ];
    }
}
