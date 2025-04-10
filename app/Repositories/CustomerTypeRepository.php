<?php

namespace App\Repositories;

use App\Repositories\Contracts\CustomerTypeRepositoryInterface;
use App\Models\CustomerType;

class CustomerTypeRepository implements CustomerTypeRepositoryInterface
{
    protected $customerType;

    public function __construct(CustomerType $customerType)
    {
        $this->customerType = $customerType;
    }

    public function all(array $filters = [])
    {
        return $this->customerType::query()
            ->applyFilters($filters)
            ->paginate(request('per_page', 15));
    }

    public function find($id)
    {
        return $this->customerType->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->customerType->create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'discount_percentage' => $data['discountPercentage'],
        ]);
    }

    public function update($id, array $data)
    {
       $customerType = $this->find($id);

        $customerType->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'discount_percentage' => $data['discountPercentage'],
        ]);

        return $customerType->fresh();
    }

    public function delete($id)
    {
        $customerType = $this->find($id);

        if ($customerType->customers()->exists()) {
            return response()->json([
                'message' => 'Cannot delete customer type with existing customers.',
            ], 422);
        }

        return $customerType->delete();
    }
}
