<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarCollection;
use App\Http\Resources\CarResource;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        return new CarCollection(Car::with('carModel.carBrand', 'user')->get());
    }

    public function show(Car $Car)
    {
        return new CarResource($Car->load('carModel.carBrand', 'user'));

    }

}
