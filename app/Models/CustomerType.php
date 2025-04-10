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
        'discount_percentage',
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }


    public function scopeApplyFilters($query, array $filters)
    {
        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['description'])) {
            $query->where('description', 'like', '%' . $filters['description'] . '%');
        }

        if (isset($filters['discountPercentage'])) {
            $query->where('discount_percentage', '<=', $filters['discountPercentage']);
        }

        return $query;
    }
}
