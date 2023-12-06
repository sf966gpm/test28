<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarModelCollection;
use App\Http\Resources\CarModelResource;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelController extends Controller
{

    public function index()
    {
        return new CarModelCollection(CarModel::all());
    }

    public function show(CarModel $CarModel)
    {
        return new CarModelResource($CarModel);
    }
}
