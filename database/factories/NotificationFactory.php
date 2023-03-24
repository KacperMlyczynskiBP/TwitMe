<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sender_id'=>User::pluck('id')->random(),
            'receiver_id'=>User::pluck('id')->random(),
            'comment'=>fake()->paragraph(1),
            'type'=>'App\Models\Like',
            'from_verified'=>true,
            'is_mentioned'=>false,
        ];
    }
}
