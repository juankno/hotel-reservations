<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
