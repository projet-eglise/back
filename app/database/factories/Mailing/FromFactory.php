<?php

namespace Database\Factories\Mailing;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mailing\From>
 */
class FromFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => Str::uuid()->toString(),
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
        ];
    }
}
