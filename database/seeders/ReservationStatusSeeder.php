<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('reservation_statuses')->insert([
            [
                'name' => 'Pendiente',
                'description' => 'Reserva pendiente de confirmación',
            ],
            [
                'name' => 'Confirmada',
                'description' => 'Reserva confirmada',
            ],
            [
                'name' => 'Check-in',
                'description' => 'Cliente en el hotel',
            ],
            [
                'name' => 'Check-out',
                'description' => 'Cliente ha salido del hotel',
            ],
            [
                'name' => 'Cancelada',
                'description' => 'Reserva cancelada',
            ],
        ]);
    }
}
