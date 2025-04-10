<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'room_id',
        'check_in_date',
        'check_out_date',
        'number_of_guests',
        'total_price',
        'reservation_status_id',
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'total_price' => 'decimal:2',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function reservationStatus()
    {
        return $this->belongsTo(ReservationStatus::class);
    }


    public function scopeApplyFilters($query, array $filters)
    {
        if (isset($filters['customer'])) {
            $query->where('customer_id', $filters['customer']);
        }

        if (isset($filters['room'])) {
            $query->where('room_id', $filters['room']);
        }

        if (isset($filters['checkInDate'])) {
            $query->whereDate('check_in_date', $filters['checkInDate']);
        }

        if (isset($filters['checkOutDate'])) {
            $query->whereDate('check_out_date', $filters['checkOutDate']);
        }

        if (isset($filters['numberOfGuests'])) {
            $query->where('number_of_guests', $filters['numberOfGuests']);
        }

        if (isset($filters['reservationStatus'])) {
            $query->where('reservation_status_id', $filters['reservationStatus']);
        }

        return $query;
    }
}
