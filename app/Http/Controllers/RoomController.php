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
     * Create a new room.
     *
     * This method is responsible for creating a new room based on the provided request data.
     */
    public function store(StoreRoomRequest $request)
    {
        $room = $this->roomRepository->create($request->validated());

        return new RoomResource($room);
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
     * Update the room.
     *
     * This method updates the room based on the provided request data.
     */
    public function update(UpdateRoomRequest $request, int $roomId)
    {
        $room = $this->roomRepository->update($roomId, $request->validated());

        return new RoomResource($room);
    }

    /**
     * Remove a room.
     *
     * This method deletes a room based on the provided ID.
     */
    public function destroy(int $roomId)
    {
        $this->roomRepository->delete($roomId);

        return response()->json([
            'success' => true,
            'message' => 'Room deleted successfully',
        ], Response::HTTP_NO_CONTENT);
    }
}
