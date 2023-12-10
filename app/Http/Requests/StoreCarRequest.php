<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
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
            'car_model_id' => ['required', 'integer', 'exists:car_models,id'],
            'vehicle_year' => ['nullable', 'integer', 'between:1880,2025'],
            'mileage' => ['nullable', 'integer', 'min:0'],
            'color' => ['nullable', 'hex_color'],
        ];
    }
}
