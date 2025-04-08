<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomType::factory()->create([
            'name' => 'simple',
            'description' => 'Una habitación sencilla con cama individual.',
            'price_per_night' => 100,
            'capacity' => 1,
        ]);

        RoomType::factory()->create([
            'name' => 'doble',
            'description' => 'Una habitación doble con dos camas individuales.',
            'price_per_night' => 150,
            'capacity' => 2,
        ]);

        RoomType::factory()->create([
            'name' => 'matrimonial,',
            'description' => 'Una habitación matrimonial con cama doble.',
            'price_per_night' => 250,
            'capacity' => 2,
        ]);
    }
}
