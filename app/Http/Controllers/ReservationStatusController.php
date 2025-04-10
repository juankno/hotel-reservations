<?php

namespace App\Http\Controllers;

use App\Models\ReservationStatus;
use App\Http\Requests\StoreReservationStatusRequest;
use App\Http\Requests\UpdateReservationStatusRequest;

class ReservationStatusController extends Controller
{
    /**
     * Listar estados de reservación
     *
     * Recupera una colección de todos los estados de reservación disponibles.
     *
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index()
    {
        //
    }

    /**
     * Crear estado de reservación
     *
     * Registra un nuevo estado de reservación en la base de datos.
     *
     * @param  \App\Http\Requests\StoreReservationStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReservationStatusRequest $request)
    {
        //
    }

    /**
     * Ver estado de reservación
     *
     * Muestra detalles de un estado de reservación específico.
     *
     * @param  \App\Models\ReservationStatus  $reservationStatus
     * @return \Illuminate\Http\Response
     */
    public function show(ReservationStatus $reservationStatus)
    {
        //
    }

    /**
     * Actualizar estado de reservación
     *
     * Modifica los detalles de un estado de reservación existente.
     *
     * @param  \App\Http\Requests\UpdateReservationStatusRequest  $request
     * @param  \App\Models\ReservationStatus  $reservationStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReservationStatusRequest $request, ReservationStatus $reservationStatus)
    {
        //
    }

    /**
     * Eliminar estado de reservación
     *
     * Elimina un estado de reservación de la base de datos.
     *
     * @param  \App\Models\ReservationStatus  $reservationStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReservationStatus $reservationStatus)
    {
        //
    }
}
