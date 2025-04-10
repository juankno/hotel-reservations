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
     * Listar tipos de cliente
     *
     * Recupera una colección de todos los tipos de cliente disponibles.
     *
     * @param \App\Http\Requests\FilterCustomerTypeRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(FilterCustomerTypeRequest $request)
    {
        $customerTypes = $this->customerTypeRepository->all($request->validated());
        return CustomerTypeResource::collection($customerTypes);
    }

    /**
     * Crear tipo de cliente
     *
     * Registra un nuevo tipo de cliente en la base de datos.
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
     * Ver tipo de cliente
     *
     * Muestra detalles de un tipo de cliente específico.
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
     * Actualizar tipo de cliente
     *
     * Modifica los detalles de un tipo de cliente existente.
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
     * Eliminar tipo de cliente
     *
     * Elimina un tipo de cliente de la base de datos.
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
