<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer' => 'sometimes|integer|exists:App\Models\Customer,id',
            'room' => 'sometimes|exists:App\Models\Room,id',
            'checkInDate' => 'sometimes|date',
            'checkOutDate' => 'sometimes|date|after:check_in_date',
            'numberOfGuests' => 'sometimes|integer|min:1',
            'reservationStatus' => 'sometimes|integer|exists:App\Models\ReservationStatus,id',
        ];
    }
}
