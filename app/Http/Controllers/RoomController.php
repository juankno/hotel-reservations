<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRoomRequest;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Http\Resources\RoomResource;
use App\Repositories\Contracts\RoomRepositoryInterface;
use Illuminate\Http\Response;

class RoomController extends Controller
{

    public function __construct(protected RoomRepositoryInterface $roomRepository) {}


    /**
     * Listar habitaciones
     *
     * Recupera todas las habitaciones y las filtra según los parámetros de consulta proporcionados.
     *
     * @param \App\Http\Requests\FilterRoomRequest $request
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index(FilterRoomRequest $request)
    {
        $rooms = $this->roomRepository->all($request->validated());

        return RoomResource::collection($rooms);
    }

    /**
     * Crear habitación
     *
     * Registra una nueva habitación en base a los datos proporcionados.
     *
     * @param \App\Http\Requests\StoreRoomRequest $request
     * @return \App\Http\Resources\RoomResource
     */
    public function store(StoreRoomRequest $request)
    {
        $room = $this->roomRepository->create($request->validated());

        return new RoomResource($room);
    }

    /**
     * Ver habitación
     *
     * Muestra detalles de una habitación específica por su ID.
     *
     * @param int $roomId
     * @return \App\Http\Resources\RoomResource|\Illuminate\Http\JsonResponse
     */
    public function show(int $roomId)
    {
        try {
            $room = $this->roomRepository->find($roomId);
            return new RoomResource($room);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Habitación no encontrada',
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Actualizar habitación
     *
     * Modifica los detalles de una habitación existente.
     *
     * @param \App\Http\Requests\UpdateRoomRequest $request
     * @param int $roomId
     * @return \App\Http\Resources\RoomResource|\Illuminate\Http\JsonResponse
     */
    public function update(UpdateRoomRequest $request, int $roomId)
    {
        try {
            $room = $this->roomRepository->update($roomId, $request->validated());
            return new RoomResource($room);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Habitación no encontrada',
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Eliminar habitación
     *
     * Elimina una habitación específica por su ID.
     *
     * @param int $roomId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $roomId)
    {
        try {
            $this->roomRepository->delete($roomId);

            return response()->json([
                'success' => true,
                'message' => 'Habitación eliminada exitosamente',
            ], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
