<?php

namespace App\Repositories;

use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    protected $customer;

    public function __construct(Customer $customer) {
        $this->customer = $customer;
    }

    public function all()
    {
        return $this->customer->all();
    }

    public function find($id)
    {
        return $this->customer->find($id);
    }

    public function create(array $data)
    {
        return $this->customer->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->customer->find($id);
        return $model ? tap($model)->update($data) : false;
    }

    public function delete($id)
    {
        $model = $this->customer->find($id);
        return $model ? $model->delete() : false;
    }
}