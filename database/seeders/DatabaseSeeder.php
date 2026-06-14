<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\WasteType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeding Data Default Jenis Sampah
        WasteType::insert([
            ['name' => 'Plastik', 'prefix_code' => 'PLS', 'price_per_kg' => 2000, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kertas', 'prefix_code' => 'KRT', 'price_per_kg' => 1500, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Logam', 'prefix_code' => 'LGM', 'price_per_kg' => 3000, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Memanggil semua seeder
        $this->call([
            AdminSeeder::class,
            RewardSeeder::class,
        ]);
    }
}
