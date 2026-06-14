<?php

namespace Database\Seeders;

use App\Models\Reward;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rewards = [
            [
                'name' => 'Pulsa 10rb',
                'price' => 11000,
                'icon' => '📱',
                'description' => 'Voucher pulsa 10rb All Operator',
            ],
            [
                'name' => 'Token Listrik 20rb',
                'price' => 22000,
                'icon' => '⚡',
                'description' => 'Voucher token listrik PLN 20rb',
            ],
            [
                'name' => 'Paket Sembako',
                'price' => 90000,
                'icon' => '🛍️',
                'description' => 'Paket sembako senilai 90rb (Beras, Minyak, Gula)',
            ],
        ];

        foreach ($rewards as $reward) {
            Reward::create($reward);
        }
    }
}
