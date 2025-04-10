<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Reservation;
use App\Models\ReservationStatus;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener IDs existentes de customers, rooms y estados de reservación
        $customerIds = Customer::pluck('id')->toArray();
        $roomIds = Room::pluck('id')->toArray();
        $statusIds = ReservationStatus::pluck('id', 'name')->toArray();

        if (empty($customerIds) || empty($roomIds) || empty($statusIds)) {
            $this->command->warn('Faltan datos necesarios para crear reservaciones. Asegúrate de que existan clientes, habitaciones y estados de reservación.');
            return;
        }

        // Reservaciones pasadas (completadas)
        for ($i = 0; $i < 20; $i++) {
            $checkInDate = Carbon::now()->subDays(rand(60, 365));
            $checkOutDate = (clone $checkInDate)->addDays(rand(1, 14));

            Reservation::create([
                'customer_id' => $customerIds[array_rand($customerIds)],
                'room_id' => $roomIds[array_rand($roomIds)],
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'number_of_guests' => rand(1, 4),
                'total_price' => rand(10000, 50000) / 100, // Entre 100 y 500
                'reservation_status_id' => $statusIds['Check-out'], // Todas las pasadas están en check-out
                'created_at' => (clone $checkInDate)->subDays(rand(10, 30)),
                'updated_at' => $checkOutDate,
            ]);
        }

        // Reservaciones actuales (check-in)
        for ($i = 0; $i < 5; $i++) {
            $checkInDate = Carbon::now()->subDays(rand(1, 5));
            $checkOutDate = Carbon::now()->addDays(rand(1, 5));

            Reservation::create([
                'customer_id' => $customerIds[array_rand($customerIds)],
                'room_id' => $roomIds[array_rand($roomIds)],
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'number_of_guests' => rand(1, 4),
                'total_price' => rand(10000, 50000) / 100,
                'reservation_status_id' => $statusIds['Check-in'], // Huésped está actualmente en el hotel
                'created_at' => (clone $checkInDate)->subDays(rand(10, 30)),
                'updated_at' => $checkInDate,
            ]);
        }

        // Reservaciones futuras (confirmadas)
        for ($i = 0; $i < 15; $i++) {
            $checkInDate = Carbon::now()->addDays(rand(5, 60));
            $checkOutDate = (clone $checkInDate)->addDays(rand(1, 14));

            Reservation::create([
                'customer_id' => $customerIds[array_rand($customerIds)],
                'room_id' => $roomIds[array_rand($roomIds)],
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'number_of_guests' => rand(1, 4),
                'total_price' => rand(10000, 50000) / 100,
                'reservation_status_id' => $statusIds['Confirmada'],
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => Carbon::now()->subDays(rand(0, 5)),
            ]);
        }

        // Reservaciones pendientes
        for ($i = 0; $i < 8; $i++) {
            $checkInDate = Carbon::now()->addDays(rand(5, 90));
            $checkOutDate = (clone $checkInDate)->addDays(rand(1, 10));

            Reservation::create([
                'customer_id' => $customerIds[array_rand($customerIds)],
                'room_id' => $roomIds[array_rand($roomIds)],
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'number_of_guests' => rand(1, 3),
                'total_price' => rand(10000, 50000) / 100,
                'reservation_status_id' => $statusIds['Pendiente'],
                'created_at' => Carbon::now()->subDays(rand(0, 5)),
                'updated_at' => Carbon::now()->subDays(rand(0, 5)),
            ]);
        }

        // Reservaciones canceladas
        for ($i = 0; $i < 7; $i++) {
            $reservationDate = Carbon::now()->subDays(rand(10, 60));
            $checkInDate = (clone $reservationDate)->addDays(rand(15, 45));
            $checkOutDate = (clone $checkInDate)->addDays(rand(1, 7));

            Reservation::create([
                'customer_id' => $customerIds[array_rand($customerIds)],
                'room_id' => $roomIds[array_rand($roomIds)],
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'number_of_guests' => rand(1, 5),
                'total_price' => rand(10000, 50000) / 100,
                'reservation_status_id' => $statusIds['Cancelada'],
                'created_at' => $reservationDate,
                'updated_at' => (clone $reservationDate)->addDays(rand(1, 10)),
            ]);
        }

        $this->command->info('Se han creado ' . Reservation::count() . ' reservaciones de prueba.');
    }
}
