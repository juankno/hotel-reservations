<?php

namespace App\Http\Controllers;

use App\Models\ReservationStatus;
use App\Http\Requests\StoreReservationStatusRequest;
use App\Http\Requests\UpdateReservationStatusRequest;

class ReservationStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ReservationStatus $reservationStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationStatusRequest $request, ReservationStatus $reservationStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReservationStatus $reservationStatus)
    {
        //
    }
}
