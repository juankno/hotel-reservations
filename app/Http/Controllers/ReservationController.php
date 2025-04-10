<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterReservationRequest;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Repositories\Contracts\ReservationRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class ReservationController extends Controller
{
    public function __construct(protected ReservationRepositoryInterface $reservationRepository) {}

    /**
     * Listar reservaciones
     *
     * Recupera una colección de todas las reservaciones disponibles.
     *
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index(FilterReservationRequest $request)
    {
        $reservations = $this->reservationRepository->all($request->validated());
        return ReservationResource::collection($reservations);
    }

    /**
     * Crear reservación
     *
     * Registra una nueva reservación en la base de datos.
     *
     * @param  \App\Http\Requests\StoreReservationRequest  $request
     * @return \App\Http\Resources\ReservationResource
     */
    public function store(StoreReservationRequest $request)
    {
        try {
            $reservation = $this->reservationRepository->create($request->validated());
            return (new ReservationResource($reservation))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Ver reservación
     *
     * Muestra detalles de una reservación específica.
     *
     * @param  int  $id
     * @return \App\Http\Resources\ReservationResource|\Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        try {
            $reservation = $this->reservationRepository->find($id);
            return new ReservationResource($reservation);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Reservación no encontrada',
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Actualizar reservación
     *
     * Modifica los detalles de una reservación existente.
     *
     * @param  \App\Http\Requests\UpdateReservationRequest  $request
     * @param  int  $id
     * @return \App\Http\Resources\ReservationResource|\Illuminate\Http\JsonResponse
     */
    public function update(UpdateReservationRequest $request, int $id)
    {
        try {
            $reservation = $this->reservationRepository->update($id, $request->validated());
            return new ReservationResource($reservation);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Reservación no encontrada',
            ], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Eliminar reservación
     *
     * Elimina una reservación de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $this->reservationRepository->delete($id);
            return response()->json([
                'success' => true,
                'message' => 'Reservación eliminada exitosamente',
            ], Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Reservación no encontrada',
            ], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
