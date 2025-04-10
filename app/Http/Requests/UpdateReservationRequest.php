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
            'customerId' => 'sometimes|exists:customers,id',
            'roomId' => 'sometimes|exists:rooms,id',
            'checkInDate' => 'sometimes|date',
            'checkOutDate' => 'sometimes|date|after:check_in_date',
            'numberOfGuests' => 'sometimes|integer|min:1',
            'totalPrice' => 'sometimes|numeric|min:0',
            'reservationStatusId' => 'sometimes|exists:reservation_statuses,id',
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
            'customerId.exists' => 'El cliente seleccionado no existe',
            'roomId.exists' => 'La habitación seleccionada no existe',
            'checkInDate.date' => 'La fecha de entrada debe ser una fecha válida',
            'checkOutDate.date' => 'La fecha de salida debe ser una fecha válida',
            'checkOutDate.after' => 'La fecha de salida debe ser posterior a la fecha de entrada',
            'numberOfGuests.integer' => 'El número de huéspedes debe ser un número entero',
            'numberOfGuests.min' => 'El número de huéspedes debe ser al menos 1',
            'totalPrice.numeric' => 'El precio total debe ser un número',
            'totalPrice.min' => 'El precio total no puede ser negativo',
            'reservationStatusId.exists' => 'El estado de reservación seleccionado no existe',
        ];
    }
}
