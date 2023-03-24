<?php

namespace Database\Factories;

use App\Models\Notification;
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
        $userIds = User::pluck('id')->toArray();

        $uniqueClosure = function () use ($userIds){
            $senderId = $this->faker->randomElement($userIds);
            $receiverId = $this->faker->randomElement($userIds);

            while($senderId === $receiverId){
                $senderId = $this->faker->randomElement($userIds);
                $receiverId = $this->faker->randomElement($userIds);
            }

            return [
                'sender_id'=>$senderId,
                'receiver_id'=>$receiverId,
                'comment'=>fake()->paragraph(1),
                'type'=> $this->faker->randomElement(['App\Models\Like', 'App\Models\Follow', 'App\Models\Retweet']),
                'from_verified'=>true,
                'is_mentioned'=>false,
            ];
        };

        return $uniqueClosure();
    }
}
