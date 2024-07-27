<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Chat;
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
    public function definition(): array
    {
        
        return [
            'chat_id'=>Chat::factory(),
            'username' => fake()->randomElement(User::pluck('username')),
            'message'=>fake()->word(),
        ];
    }
}
