<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'checkInDate' => $this->check_in_date,
            'checkOutDate' => $this->check_out_date,
            'numberOfGuests' => $this->number_of_guests,
            'totalPrice' => $this->total_price,
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'room' => new RoomResource($this->whenLoaded('room')),
            'reservationStatus' => new ReservationStatusResource($this->whenLoaded('reservationStatus')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
