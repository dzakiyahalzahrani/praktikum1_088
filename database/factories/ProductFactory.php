<?php

namespace Database\Factories;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'name'=> $this->faker->word(2, true),
            'quantity' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(10000, 1000000),
            
        ];
    }
}
