<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'username' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'user_image_path' => fake()->imageUrl($width=133, $height=133),
            'date_of_birth' => fake()->dateTimeBetween($startDate= '-80 years', $endDate='now'),
            'bio' => fake()->paragraph(1),
            'location' => fake()->city(),
            'password' => Hash::make(fake()->password),
            'remember_token' => Str::random(10),
            'google_id' => NULL,
            'dob_changes' => 0,
            'blue_verified' => 0,
            'phone_number' => fake()->phoneNumber(),
            'phone_verified' => 1,
            'updated_at' => now(),
            'created_at' => now()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
