<?php

namespace App\Repositories;

use App\Repositories\Contracts\RoomRepositoryInterface;
use App\Models\Room;

class RoomRepository implements RoomRepositoryInterface
{
    protected $room;

    public function __construct(Room $room)
    {
        $this->room = $room;
    }

    public function all(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->room::with('roomType')
            ->where('is_available', $filters['status'] ?? true)
            ->applyFilters($filters)
            ->paginate(request('per_page', 10));
    }


    /**
     * Find a room by its ID.
     *
     * @param int $id
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @return Room
     */
    public function find($id): Room
    {
        return $this->room::with('roomType')->findOrFail($id);
    }

    public function create(array $data)
    {
        $room = $this->room->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'is_available' => $data['isAvailable'] ?? true,
            'room_type_id' => $data['roomTypeId'],
        ]);

        $room->load('roomType');

        return $room;
    }

    public function update(int $roomId, array $data)
    {
        $room = $this->find($roomId)->load('roomType');

        $room->update([
            'is_available' => $data['isAvailable'] ?? $room->is_available,
            'room_type_id' => $data['roomTypeId'],
            'description' => $data['description'] ?? $room->description,
        ]);

        return $this->find($roomId);
    }

    public function delete(int $id)
    {
        $room = $this->find($id);

        if ($room->reservations()->exists()) {
            throw new \Exception('Room cannot be deleted because it has reservations.');
        }

        $room->delete();
    }
}
