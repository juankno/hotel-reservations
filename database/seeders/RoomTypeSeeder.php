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
            'image' => 'https://hotelklimtxalapa.com/wp-content/uploads/2022/06/Habitacion-Sencilla-2-scaled-1200x900.jpg',
            'capacity' => 1,
        ]);

        RoomType::factory()->create([
            'name' => 'doble',
            'description' => 'Una habitación doble con dos camas individuales.',
            'price_per_night' => 150,
            'image' => 'https://hotelcasamorales.com/wp-content/uploads/2018/11/DSC016421.jpg',
            'capacity' => 2,
        ]);

        RoomType::factory()->create([
            'name' => 'matrimonial,',
            'description' => 'Una habitación matrimonial con cama doble.',
            'price_per_night' => 250,
            'image' => 'https://www.hotelbenidorm.co/assets/cache/uploads/habitaciones/627x503/habitacion-doble-matrimonial.jpg',
            'capacity' => 2,
        ]);
    }
}
