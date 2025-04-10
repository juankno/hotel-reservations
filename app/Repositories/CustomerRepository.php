<?php

namespace App\Repositories;

use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    protected $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function all(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->customer::with('customerType')
            ->applyFilters($filters)
            ->paginate(request('per_page', 10));
    }

    public function find($id)
    {
        return $this->customer->findOrFail($id)->load('customerType');
    }

    public function create(array $data)
    {
        $customer = $this->customer->create([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'rut' => $data['rut'],
            'customer_type_id' => $data['customerType'],
        ]);

        return $customer->load('customerType');
    }

    public function update($id, array $data)
    {
        $customer = $this->find($id);

        $customer->update([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'rut' => $data['rut'],
            'customer_type_id' => $data['customerType'],
        ]);

        return $customer->load('customerType');
    }

    public function delete($id)
    {
        $customer = $this->find($id);

        if ($customer->reservations()->exists()) {
            throw new \Exception('Customer cannot be deleted because they have reservations.');
        }

        return $customer->delete();
    }
}
