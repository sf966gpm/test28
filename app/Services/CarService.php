<?php

namespace App\Services;

use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Support\Facades\Auth;

class CarService
{
    public function createCar(array $validated): Car
    {
        $carModel = CarModel::find($validated['car_model_id']);

        $car = Car::create([
            'car_model_id' => $carModel->id,
            'vehicle_year' => $validated['vehicle_year'] ?? null,
            'mileage' => $validated['mileage'] ?? null,
            'color' => $validated['color'] ?? null,
            'user_id' => Auth::id(),
        ]);
        return $car;
    }

    public function updateCar(array $validated, Car $car): Car
    {
        $carModel = CarModel::find($validated['car_model_id']);

        $car->update([
            'car_model_id' => $carModel->id,
            'vehicle_year' => $validated['vehicle_year'] ?? null,
            'mileage' => $validated['mileage'] ?? null,
            'color' => $validated['color'] ?? null,
            'user_id' => Auth::id(),
        ]);

        return $car;
    }
}
