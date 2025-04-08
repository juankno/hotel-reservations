<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:App\Models\Room,name',
            'description' => 'sometimes|string|max:255',
            'isAvailable' => 'sometimes|integer|in:0,1',
            'roomTypeId' => 'required|integer|exists:App\Models\RoomType,id',
        ];
    }
}
