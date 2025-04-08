<?php

namespace App\Repositories;

use App\Repositories\Contracts\ReservationRepositoryInterface;
use App\Models\Reservation;

class ReservationRepository implements ReservationRepositoryInterface
{
    protected $reservation;

    public function __construct(Reservation $reservation) {
        $this->reservation = $reservation;
    }

    public function all()
    {
        return $this->reservation->all();
    }

    public function find($id)
    {
        return $this->reservation->find($id);
    }

    public function create(array $data)
    {
        return $this->reservation->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->reservation->find($id);
        return $model ? tap($model)->update($data) : false;
    }

    public function delete($id)
    {
        $model = $this->reservation->find($id);
        return $model ? $model->delete() : false;
    }
}