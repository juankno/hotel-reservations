<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'is_available',
        'room_type_id',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function scopeApplyFilters($query, array $filters)
    {

        if (isset($filters['number'])) {
            $number = str_replace([' ', 'H'], '', $filters['number']);
            $query->where('name', $number);
        }

        if (isset($filters['type'])) {
            $query->whereHas('roomType', function ($q) use ($filters) {
                $q->where('id',  $filters['type']);
            });
        }

        if (isset($filters['price'])) {
            $query->whereHas('roomType', function ($q) use ($filters) {
                $q->where('price_per_night', '<=', $filters['price']);
            });
        }

        return $query;
    }
}
