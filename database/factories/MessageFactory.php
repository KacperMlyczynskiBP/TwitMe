<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\Message;
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
    public function definition(){
        $userIds = User::pluck('id')->toArray();
        $uniqueClosure = function () use ($userIds){
            $senderId = $this->faker->randomElement($userIds);
            $receiverId = $this->faker->randomElement($userIds);
            $conversationId = Conversation::pluck('id')->random();

            // Check if there's already a message with the same sender, receiver, and conversation IDs
            while(Message::where('sender_id', $senderId)
                ->where('receiver_id', $receiverId)
                ->where('conversation_id', $conversationId)
                ->exists()){
                $senderId = $this->faker->randomElement($userIds);
                $receiverId = $this->faker->randomElement($userIds);
                $conversationId = Conversation::pluck('id')->random();
            }
            return [
                'text'=>fake()->paragraph(1),
                'sender_id'=>$senderId,
                'receiver_id'=>$receiverId,
                'conversation_id'=>Conversation::pluck('id')->random(),
            ];
        };

        return $uniqueClosure();
    }
}
