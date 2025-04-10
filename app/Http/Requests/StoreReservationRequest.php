<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
            'customerId' => 'required|exists:App\Models\Customer,id',
            'roomId' => 'required|exists:App\Models\Room,id',
            'checkInDate' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'checkOutDate' => 'required|date|date_format:Y-m-d|after:check_in_date',
            'numberOfGuests' => 'required|integer|min:1',
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
            'customerId.required' => 'El cliente es obligatorio',
            'customerId.exists' => 'El cliente seleccionado no existe',
            'roomId.required' => 'La habitación es obligatoria',
            'roomId.exists' => 'La habitación seleccionada no existe',
            'checkInDate.required' => 'La fecha de entrada es obligatoria',
            'checkInDate.date' => 'La fecha de entrada debe ser una fecha válida',
            'checkInDate.date_format' => 'La fecha de entrada debe tener el formato Y-m-d',
            'checkInDate.after_or_equal' => 'La fecha de entrada debe ser hoy o una fecha futura',
            'checkOutDate.required' => 'La fecha de salida es obligatoria',
            'checkOutDate.date' => 'La fecha de salida debe ser una fecha válida',
            'checkOutDate.date_format' => 'La fecha de salida debe tener el formato Y-m-d',
            'checkOutDate.after' => 'La fecha de salida debe ser posterior a la fecha de entrada',
            'numberOfGuests.required' => 'El número de huéspedes es obligatorio',
            'numberOfGuests.integer' => 'El número de huéspedes debe ser un número entero',
            'numberOfGuests.min' => 'El número de huéspedes debe ser al menos 1',
        ];
    }
}
