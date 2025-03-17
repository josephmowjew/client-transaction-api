<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 clients with fake data
        for ($i = 0; $i < 10; $i++) {
            $name = fake()->firstName();
            Client::create([
                'name' => $name,
                'surname' => fake()->lastName(),
                'email' => fake()->unique()->safeEmail(),
                'phone' => fake()->phoneNumber(),
                'income' => fake()->randomFloat(2, 30000, 150000),
            ]);
        }
    }
}
