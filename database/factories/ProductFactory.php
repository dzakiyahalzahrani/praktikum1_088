<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'name' => $this->faker->words(2, true), // <-- perbaikan penting
            'quantity' => $this->faker->numberBetween(1, 100), // <-- perbaikan penting
            'price' => $this->faker->numberBetween(10000, 1000000), // <-- perbaikan penting
        ];
    }
}