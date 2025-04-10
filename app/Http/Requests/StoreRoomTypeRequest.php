<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomTypeRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:App\Models\RoomType,name',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'isAvailable' => 'nullable|boolean',
            'image' => 'nullable|string',
        ];
    }
}
