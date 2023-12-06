<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarBrandCollection;
use App\Http\Resources\CarBrandResource;
use App\Models\CarBrand;
use Illuminate\Http\Request;

class CarBrandController extends Controller
{
    /**
     * Показать все
     * @param Request $request
     * @return CarBrandCollection
     */
    public function index(Request $request): CarBrandCollection
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
