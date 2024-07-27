<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chat>
 */
class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username_1' => $username1 = fake()->randomElement(User::pluck('username')),
            'username_2' => fake()->randomElement(User::where('username', '!=', $username1)->pluck('username')),
        ];
    }
}
