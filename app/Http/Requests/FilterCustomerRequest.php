<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterCustomerRequest extends FormRequest
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
            'firstName' => 'sometimes|string|max:255',
            'lastName' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'phone' => 'sometimes|numeric',
            'rut' => 'sometimes|string|max:20',
            'customerType' => 'sometimes|exists:App\Models\CustomerType,id',
        ];
    }
}
