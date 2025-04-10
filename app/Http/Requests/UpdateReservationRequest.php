<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
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
            'customer' => 'required|integer|exists:App\Models\Customer,id',
            'room' => 'required|integer|exists:App\Models\Room,id',
            'checkInDate' => 'required|date|date_format:Y-m-d',
            'checkOutDate' => 'required|date|after:check_in_date|date_format:Y-m-d',
            'numberOfGuests' => 'required|integer|min:1',
            'reservationStatus' => 'sometimes|integer|exists:App\Models\ReservationStatus,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'customer.exists' => 'El cliente seleccionado no existe',
            'room.exists' => 'La habitación seleccionada no existe',
            'checkInDate.date' => 'La fecha de entrada debe ser una fecha válida',
            'checkOutDate.date' => 'La fecha de salida debe ser una fecha válida',
            'checkOutDate.after' => 'La fecha de salida debe ser posterior a la fecha de entrada',
            'numberOfGuests.integer' => 'El número de huéspedes debe ser un número entero',
            'numberOfGuests.min' => 'El número de huéspedes debe ser al menos 1',
            'reservationStatus.exists' => 'El estado de reservación seleccionado no existe',
        ];
    }
}
