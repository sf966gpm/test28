<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarBrandCollection;
use App\Http\Resources\CarBrandResource;
use App\Models\CarBrand;

class CarBrandController extends Controller
{
    /**
     * Показать все
     * @return CarBrandCollection
     */
    public function index(): CarBrandCollection
    {
        return new CarBrandCollection(CarBrand::all());
    }

    /**
     * Показать бренд по id
     *
     * Странный biding нарушает PHP Code Style Conventions
     * Пока пусть будет так
     * @param CarBrand $CarBrand
     * @return CarBrandResource
     */
    public function show(CarBrand $CarBrand): CarBrandResource
    {
        return new CarBrandResource($CarBrand);
    }
}
