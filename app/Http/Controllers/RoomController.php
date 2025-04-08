<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRoomRequest;
use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Http\Resources\RoomResource;
use App\Repositories\Contracts\RoomRepositoryInterface;


class RoomController extends Controller
{

    public function __construct(protected RoomRepositoryInterface $roomRepository) {}


    /**
     * List all rooms.
     *
     * This method is responsible for retrieving all rooms and filtering them based on the provided query parameters.
     */
    public function index(FilterRoomRequest $request)
    {
        $rooms = $this->roomRepository->all($request->validated());

        return RoomResource::collection($rooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        //
    }

    /**
     * Show the specified room.
     *
     * This method retrieves a specific room by its ID and returns its details.
     */
    public function show(int $roomId)
    {
        $room = $this->roomRepository->find($roomId);

        return new RoomResource($room);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}
