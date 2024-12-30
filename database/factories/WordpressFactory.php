<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Factory>
 */
class WordpressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'baseuri' => 'https://maqueta.online',
            'username' => 'dani-venegas',
            'password' => 'q$)owHhWzX@&OPNg'
        ];
    }
}
