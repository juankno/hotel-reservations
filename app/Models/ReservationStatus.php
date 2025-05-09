<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationStatus extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationStatusFactory> */
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];


    protected $casts = [
        'is_active' => 'boolean',
    ];

}
