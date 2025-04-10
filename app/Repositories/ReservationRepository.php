<?php

namespace App\Repositories;

use App\Repositories\Contracts\ReservationRepositoryInterface;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        return $this->reservation->create($data);
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
