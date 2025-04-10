<?php

namespace App\Http\Controllers;

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
     * Display a listing of the resource.
     *
     * Retrieves a collection of reservations.
     *
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index()
    {
        $reservations = $this->reservationRepository->all();
        return ReservationResource::collection($reservations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * Stores a new reservation in the database.
     *
     * @param  \App\Http\Requests\StoreReservationRequest  $request
     * @return \App\Http\Resources\ReservationResource
     */
    public function store(StoreReservationRequest $request)
    {
        $reservation = $this->reservationRepository->create($request->validated());
        return (new ReservationResource($reservation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * Displays details of a specific reservation.
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
     * Update the specified resource in storage.
     *
     * Modifies details of an existing reservation.
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
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * Removes a reservation from the database.
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
        }
    }
}
