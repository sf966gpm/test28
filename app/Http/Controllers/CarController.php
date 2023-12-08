<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarCollection;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function index(): JsonResource
    {
        return new CarCollection(
            Car::with('carModel.carBrand', 'user')
                ->where('user_id', Auth::id())
                ->paginate()
        );
    }

    public function show(Car $car): JsonResource
    {
        return new CarResource($car->load('carModel.carBrand', 'user'));

    }

}
