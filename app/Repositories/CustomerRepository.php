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

    /**
     * Retrieve all customers with optional filters.
     *
     * @param array $filters Filters to apply to the query.
     * @return \Illuminate\Pagination\LengthAwarePaginator Paginated list of customers.
     */
    public function all(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->customer::with('customerType')
            ->applyFilters($filters)
            ->paginate(request('per_page', 10));
    }

    /**
     * Find a customer by ID.
     *
     * @param int $id Customer ID.
     * @return \App\Models\Customer The customer with related customer type.
     */
    public function find($id)
    {
        return $this->customer->findOrFail($id)->load('customerType');
    }

    /**
     * Create a new customer.
     *
     * @param array $data Data for creating the customer.
     * @return \App\Models\Customer The newly created customer with related customer type.
     */
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

    /**
     * Update an existing customer.
     *
     * @param int $id Customer ID.
     * @param array $data Data for updating the customer.
     * @return \App\Models\Customer The updated customer with related customer type.
     */
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

    /**
     * Delete a customer by ID.
     *
     * @param int $id Customer ID.
     * @throws \Exception If the customer has reservations.
     * @return bool True if the customer was deleted, false otherwise.
     */
    public function delete($id)
    {
        $customer = $this->find($id);

        if ($customer->reservations()->exists()) {
            throw new \Exception('Customer cannot be deleted because they have reservations.');
        }

        return $customer->delete();
    }
}
