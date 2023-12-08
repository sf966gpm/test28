<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarModelCollection;
use App\Http\Resources\CarModelResource;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    //avoid sending a request with relations to the database inside the resource

    public function index(): CarModelCollection
    {
        return new CarModelCollection(CarModel::with('carBrand')->paginate());
    }

    public function show(CarModel $carModel): CarModelResource
    {
        return new CarModelResource($carModel->load('carBrand'));
    }
}
