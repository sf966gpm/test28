<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarBrandCollection;
use App\Http\Resources\CarBrandResource;
use App\Models\CarBrand;

class CarBrandController extends Controller
{
    public function index(): CarBrandCollection
    {
        return new CarBrandCollection(CarBrand::paginate());
    }

    public function show(CarBrand $carBrand): CarBrandResource
    {
        return new CarBrandResource($carBrand);
    }
}
