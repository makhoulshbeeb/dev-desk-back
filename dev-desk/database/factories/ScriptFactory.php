<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ScriptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->randomElement(User::pluck('username')),
            'content' => fake()->text(),
            'language' => fake()->randomElement(['Python', 'CSS', 'JavaScript', 'C++', 'js']),
        ];
    }
}
