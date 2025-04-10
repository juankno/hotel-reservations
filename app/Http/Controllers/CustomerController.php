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
     * Listar clientes
     *
     * Recupera una colección de todos los clientes disponibles.
     *
     * @param \App\Http\Requests\FilterCustomerRequest $request
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index(FilterCustomerRequest $request)
    {
        $customers = $this->customerRepository->all($request->validated());
        return CustomerResource::collection($customers);
    }

    /**
     * Crear cliente
     *
     * Registra un nuevo cliente en la base de datos.
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
     * Ver cliente
     *
     * Muestra detalles de un cliente específico.
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
     * Actualizar cliente
     *
     * Modifica los detalles de un cliente existente.
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
     * Eliminar cliente
     *
     * Elimina un cliente de la base de datos.
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
