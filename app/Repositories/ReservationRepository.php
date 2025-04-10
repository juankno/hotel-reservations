<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Repositories\Contracts\ReservationRepositoryInterface;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;

class ReservationRepository implements ReservationRepositoryInterface
{
    protected $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Get all reservations with their relationships.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(array $filters = [])
    {
        return $this->reservation::with(['customer.customerType', 'room.roomType', 'reservationStatus'])
            ->applyFilters($filters)
            ->paginate(request('per_page', 10));
    }

    /**
     * Find a reservation by ID with its relationships.
     *
     * @param int $id
     * @return \App\Models\Reservation
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find($id)
    {
        $reservation = $this->reservation->with(['customer.customerType', 'room.roomType', 'reservationStatus'])->find($id);

        if (!$reservation) {
            throw new ModelNotFoundException("Reservation with ID {$id} not found");
        }

        return $reservation;
    }

    /**
     * Create a new reservation with the given data.
     *
     * @param array $data
     * @return \App\Models\Reservation
     */
    public function create(array $data)
    {
        $overlapping = $this->reservation::where('room_id', $data['roomId'])
            ->whereIn('reservation_status_id', [2, 3])
            ->where(function ($query) use ($data) {
                $query->whereBetween('check_in_date', [$data['checkInDate'], $data['checkOutDate']])
                    ->orWhereBetween('check_out_date', [$data['checkInDate'], $data['checkOutDate']])
                    ->orWhere(function ($query) use ($data) {
                        $query->where('check_in_date', '<=', $data['checkInDate'])
                            ->where('check_out_date', '>=', $data['checkOutDate']);
                    });
            })
            ->exists();

        if ($overlapping) {
            throw new \Exception('La habitación ya está reservada para las fechas seleccionadas.');
        }

        $room = Room::findOrFail($data['roomId'])->load('roomType');
        $customer = Customer::findOrFail($data['customerId'])->load('customerType');

        $nights = Carbon::parse($data['checkInDate'])->diffInDays(Carbon::parse($data['checkOutDate']));
        $priceNight = $room->roomType->price_per_night;

        $discount = $customer->customerType->discount_percentage ?? 0;
        $totalPrice = ($priceNight * $nights) - (($priceNight * $nights) * ($discount / 100));

        $reservation = $this->reservation->create([
            'room_id' => $data['roomId'],
            'customer_id' => $data['customerId'],
            'check_in_date' => $data['checkInDate'],
            'check_out_date' => $data['checkOutDate'],
            'total_price' => $totalPrice,
            'reservation_status_id' => 1,
            'number_of_guests' => $data['numberOfGuests'],
        ]);

        $reservation->load(['customer.customerType', 'room.roomType', 'reservationStatus']);

        return $reservation;
    }

    /**
     * Update an existing reservation with the given data.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Reservation|bool
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update($id, array $data)
    {
        $model = $this->reservation->find($id);

        if (!$model) {
            throw new ModelNotFoundException("Reservation with ID {$id} not found");
        }

        $model->update($data);
        return $model->fresh(['customer.customerType', 'room.roomType', 'reservationStatus']);
    }

    /**
     * Delete a reservation by ID.
     *
     * @param int $id
     * @return bool
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function delete($id)
    {
        $model = $this->reservation->find($id);

        if (!$model) {
            throw new ModelNotFoundException("Reservation with ID {$id} not found");
        }

        return $model->delete();
    }
}
