<?php

namespace App\Repositories;

use App\Repositories\Contracts\RoomTypeRepositoryInterface;
use App\Models\RoomType;

class RoomTypeRepository implements RoomTypeRepositoryInterface
{
    protected $roomType;

    public function __construct(RoomType $roomType)
    {
        $this->roomType = $roomType;
    }

    public function all(array $filters = [])
    {
        return $this->roomType::query()
            ->applyFilters($filters)
            ->paginate(request('per_page', 15));
    }

    public function find($id)
    {
        return $this->roomType->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->roomType->create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'price_per_night' => $data['price'],
            'capacity' => $data['capacity'],
            'is_available' => $data['isAvailable'] ?? true,
            'image' => $data['image'] ?? null,
        ]);
    }

    public function update($id, array $data)
    {
        $roomType = $this->find($id);

        $roomType->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? $roomType->description,
            'price_per_night' => $data['price'],
            'capacity' => $data['capacity'],
            'is_available' => $data['isAvailable'] ?? $roomType->is_available,
            'image' => $data['image'] ?? $roomType->image,
        ]);

        return $roomType;
    }

    public function delete($id)
    {
        $roomType = $this->find($id);

        $hasReservations = $roomType->rooms()->whereHas('reservations')->exists();

        if ($hasReservations) {
            throw new \Exception('No se puede eliminar un tipo de habitación que tiene habitaciones con reservas asociadas.');
        }

        return $roomType->delete();
    }
}
