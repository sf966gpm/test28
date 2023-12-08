<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarCollection;
use App\Http\Resources\CarResource;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('carModel.carBrand')->get();
        return new CarCollection($cars);
    }

    public function show(Car $Car)
    {
//        $cars = Car::with('carModel.carBrand')->get();
        return new CarResource($Car);

    }
//    public function index(): CarModelCollection
//    {
//        return new CarModelCollection(CarModel::all());
//    }
//
//    public function show(CarModel $CarModel): CarModelResource
//    {
//        return new CarModelResource($CarModel);
//    }
}
