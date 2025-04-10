<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    /** @use HasFactory<\Database\Factories\RoomTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'capacity',
        'price_per_night',
        'is_available',
        'image',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price_per_night' => 'decimal:2',
    ];


    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function scopeApplyFilters($query, array $filters)
    {
        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['description'])) {
            $query->where('description', 'like', '%' . $filters['description'] . '%');
        }

        if (isset($filters['capacity'])) {
            $query->where('capacity', '>=', $filters['capacity']);
        }

        if (isset($filters['price'])) {
            $query->where('price_per_night', '<=', $filters['price']);
        }

        if (isset($filters['isAvailable'])) {
            $query->where('is_available', $filters['isAvailable']);
        }

        return $query;
    }
}
