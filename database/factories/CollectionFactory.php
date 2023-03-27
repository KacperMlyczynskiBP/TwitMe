<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collection>
 */
class CollectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $userIds=User::pluck('id')->toArray();
        return [
            'comment'=>$this->faker()->unique()->sentence,
            'user_id'=>$this->faker()->randomElement($userIds),
        ];
    }
}
