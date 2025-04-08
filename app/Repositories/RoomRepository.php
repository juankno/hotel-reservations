<?php

namespace App\Repositories;

use App\Repositories\Contracts\RoomRepositoryInterface;
use App\Models\Room;

class RoomRepository implements RoomRepositoryInterface
{
    protected $room;

    public function __construct(Room $room) {
        $this->room = $room;
    }

    public function all()
    {
        return $this->room->all();
    }

    public function find($id)
    {
        return $this->room->find($id);
    }

    public function create(array $data)
    {
        return $this->room->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->room->find($id);
        return $model ? tap($model)->update($data) : false;
    }

    public function delete($id)
    {
        $model = $this->room->find($id);
        return $model ? $model->delete() : false;
    }
}