<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'rut',
        'customer_type_id',
    ];

    public function customerType()
    {
        return $this->belongsTo(CustomerType::class);
    }


    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }


    public function scopeApplyFilters($query, array $filters)
    {
        if (isset($filters['firstName'])) {
            $query->where('first_name', 'like', '%' . $filters['firstName'] . '%');
        }

        if (isset($filters['lastName'])) {
            $query->where('last_name', 'like', '%' . $filters['lastName'] . '%');
        }

        if (isset($filters['email'])) {
            $query->where('email', 'like', '%' . $filters['email'] . '%');
        }

        if (isset($filters['phone'])) {
            $query->where('phone', 'like', '%' . $filters['phone'] . '%');
        }

        if (isset($filters['rut'])) {
            $query->where('rut', 'like', '%' . $filters['rut'] . '%');
        }

        if (isset($filters['customerType'])) {
            $query->where('customer_type_id', $filters['customerType']);
        }

        return $query;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
