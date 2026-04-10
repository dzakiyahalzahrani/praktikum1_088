<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat 1 user
        $user = User::factory()->create([
            'name' => 'Ayo Belajar',
            'email' => 'belajar@example.com',
            'password' => bcrypt('password'),
        ]);

        Product::factory(20)->create();
        Category::factory(10)->create();
    
    }
}