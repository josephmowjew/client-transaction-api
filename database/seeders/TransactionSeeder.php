<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all client IDs
        $clientIds = Client::pluck('id')->toArray();

        // Create 5 transactions for each client
        foreach ($clientIds as $clientId) {
            for ($i = 0; $i < 5; $i++) {
                Transaction::create([
                    'client_id' => $clientId,
                    'amount' => fake()->randomFloat(2, 10, 1000),
                    'type' => fake()->randomElement(['credit', 'debit']),
                    'description' => fake()->sentence(),
                ]);
            }
        }
    }
}
