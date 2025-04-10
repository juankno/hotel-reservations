<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterCustomerRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    public function __construct(protected CustomerRepositoryInterface $customerRepository) {}

    /**
     * List all customers.
     *
     * Retrieves a collection of customers.
     *
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index(FilterCustomerRequest $request)
    {
        $customers = $this->customerRepository->all($request->validated());
        return CustomerResource::collection($customers);
    }

    /**
     * Create a customer.
     *
     * Stores a new customer in the database.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \App\Http\Resources\CustomerResource
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = $this->customerRepository->create($request->validated());
        return new CustomerResource($customer);
    }

    /**
     * Show a customer.
     *
     * Displays details of a specific customer.
     *
     * @param  int  $id
     * @return \App\Http\Resources\CustomerResource
     */
    public function show(int $id)
    {
        $customer = $this->customerRepository->find($id);
        return new CustomerResource($customer);
    }

    /**
     * Update a customer.
     *
     * Modifies details of an existing customer.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  int  $id
     * @return \App\Http\Resources\CustomerResource
     */
    public function update(UpdateCustomerRequest $request, int $id)
    {
        $customer = $this->customerRepository->update($id, $request->validated());
        return new CustomerResource($customer);
    }

    /**
     * Delete a customer.
     *
     * Removes a customer from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $this->customerRepository->delete($id);
        return response()->json([
            'success' => true,
            'message' => 'Customer deleted successfully',
        ], Response::HTTP_NO_CONTENT);
    }
}
