<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarModelCollection;
use App\Http\Resources\CarModelResource;
use App\Models\CarModel;
class CarModelController extends Controller
{
    //avoid sending a request with relations to the database inside the resource

    public function index(): CarModelCollection
    {
        return CarModelCollection::make(CarModel::with('carBrand')->paginate());
    }

    public function show(CarModel $carModel): CarModelResource
    {
        return CarModelResource::make($carModel->load('carBrand'));
    }
}
