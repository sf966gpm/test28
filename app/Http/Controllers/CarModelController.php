<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarModelCollection;
use App\Http\Resources\CarModelResource;
use App\Models\CarModel;

class CarModelController extends Controller
{

    public function index(): CarModelCollection
    {
        return new CarModelCollection(CarModel::all());
    }

    public function show(CarModel $CarModel): CarModelResource
    {
        return new CarModelResource($CarModel);
    }
}
