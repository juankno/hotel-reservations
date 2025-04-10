<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:App\Models\Customer,email',
            'phone' => 'nullable|numeric|min:10,max:15',
            'address' => 'nullable|string|max:255',
            'rut' => 'required|string|max:20|unique:App\Models\Customer,rut',
            'customerType' => 'required|integer|exists:App\Models\CustomerType,id',
        ];
    }
}
