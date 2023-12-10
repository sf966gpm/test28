<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateCarRequest extends FormRequest
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
            'car_model_id' => ['sometimes', 'integer'],
            'vehicle_year' => ['nullable', 'integer'],
            'mileage' => ['nullable', 'integer'],
            'color' => ['nullable', 'hex_color'],
        ];
    }
}
