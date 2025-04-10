<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRoomTypeRequest;
use App\Http\Requests\StoreRoomTypeRequest;
use App\Http\Requests\UpdateRoomTypeRequest;
use App\Http\Resources\RoomTypeResource;
use App\Repositories\Contracts\RoomTypeRepositoryInterface;
use Illuminate\Http\Response;

class RoomTypeController extends Controller
{
    protected $roomTypeRepository;

    public function __construct(RoomTypeRepositoryInterface $roomTypeRepository)
    {
        $this->roomTypeRepository = $roomTypeRepository;
    }

    /**
     * Listar tipos de habitación
     *
     * Recupera una colección de todos los tipos de habitación disponibles.
     *
     * @param \App\Http\Requests\FilterRoomTypeRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(FilterRoomTypeRequest $request)
    {
        $roomTypes = $this->roomTypeRepository->all($request->validated());
        return RoomTypeResource::collection($roomTypes);
    }

    /**
     * Crear tipo de habitación
     *
     * Registra un nuevo tipo de habitación en la base de datos.
     *
     * @param  \App\Http\Requests\StoreRoomTypeRequest  $request
     * @return \App\Http\Resources\RoomTypeResource
     */
    public function store(StoreRoomTypeRequest $request)
    {
        $roomType = $this->roomTypeRepository->create($request->validated());
        return new RoomTypeResource($roomType);
    }

    /**
     * Ver tipo de habitación
     *
     * Muestra detalles de un tipo de habitación específico.
     *
     * @param  int  $id
     * @return \App\Http\Resources\RoomTypeResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $roomType = $this->roomTypeRepository->find($id);
            return new RoomTypeResource($roomType);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tipo de habitación no encontrado',
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Actualizar tipo de habitación
     *
     * Modifica los detalles de un tipo de habitación existente.
     *
     * @param  \App\Http\Requests\UpdateRoomTypeRequest  $request
     * @param  int  $id
     * @return \App\Http\Resources\RoomTypeResource|\Illuminate\Http\JsonResponse
     */
    public function update(UpdateRoomTypeRequest $request, $id)
    {
        try {
            $roomType = $this->roomTypeRepository->update($id, $request->validated());
            return new RoomTypeResource($roomType);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tipo de habitación no encontrado',
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Eliminar tipo de habitación
     *
     * Elimina un tipo de habitación de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->roomTypeRepository->delete($id);
            return response()->json(['message' => 'Tipo de habitación eliminado con éxito.'], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
