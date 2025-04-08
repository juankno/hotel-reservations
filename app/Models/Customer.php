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
}
