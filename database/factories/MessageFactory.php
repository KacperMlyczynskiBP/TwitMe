<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'text'=>fake()->paragraph(1),
            'sender_id'=>User::pluck('id')->random(),
            'receiver_id'=>User::pluck('id')->random(),
            'conversation_id'=>Conversation::pluck('id')->random(),
        ];
    }
}
