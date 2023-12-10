<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'vehicle_year' => $this->vehicle_year,
            'mileage' => $this->mileage,
            'color' => $this->color,
            'car_model' => new CarModelResource($this->carModel),
            'user' => new UserResource($this->user)
        ];
    }
}
