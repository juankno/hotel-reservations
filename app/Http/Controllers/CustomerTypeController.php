<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterCustomerTypeRequest;
use App\Http\Requests\StoreCustomerTypeRequest;
use App\Http\Requests\UpdateCustomerTypeRequest;
use App\Repositories\Contracts\CustomerTypeRepositoryInterface;
use App\Http\Resources\CustomerTypeResource;
use Illuminate\Http\Response;

class CustomerTypeController extends Controller
{
    protected $customerTypeRepository;

    public function __construct(CustomerTypeRepositoryInterface $customerTypeRepository)
    {
        $this->customerTypeRepository = $customerTypeRepository;
    }

    /**
     * List Customer Types
     *
     * Retrieves a list of all customer types.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(FilterCustomerTypeRequest $request)
    {
        $customerTypes = $this->customerTypeRepository->all($request->validated());
        return CustomerTypeResource::collection($customerTypes);
    }

    /**
     * Create Customer Type
     *
     * Stores a new customer type in the database.
     *
     * @param  \App\Http\Requests\StoreCustomerTypeRequest  $request
     * @return \App\Http\Resources\CustomerTypeResource
     */
    public function store(StoreCustomerTypeRequest $request)
    {
        $customerType = $this->customerTypeRepository->create($request->validated());
        return new CustomerTypeResource($customerType);
    }

    /**
     * Show Customer Type
     *
     * Displays details of a specific customer type.
     *
     * @param  int  $id
     * @return \App\Http\Resources\CustomerTypeResource
     */
    public function show($id)
    {
        $customerType = $this->customerTypeRepository->find($id);
        return new CustomerTypeResource($customerType);
    }

    /**
     * Update Customer Type
     *
     * Updates the details of an existing customer type.
     *
     * @param  \App\Http\Requests\UpdateCustomerTypeRequest  $request
     * @param  int  $id
     * @return \App\Http\Resources\CustomerTypeResource
     */
    public function update(UpdateCustomerTypeRequest $request, $id)
    {
        $customerType = $this->customerTypeRepository->update($id, $request->validated());
        return new CustomerTypeResource($customerType);
    }

    /**
     * Delete Customer Type
     *
     * Removes a customer type from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->customerTypeRepository->delete($id);
        return response()->json(['message' => 'Customer type deleted successfully.'], Response::HTTP_NO_CONTENT);
    }
}
