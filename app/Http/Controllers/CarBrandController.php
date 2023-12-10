<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarBrandCollection;
use App\Http\Resources\CarBrandResource;
use App\Models\CarBrand;
use Illuminate\Http\JsonResponse;

class CarBrandController extends Controller
{
    public function index(): JsonResponse
    {
        $carBrandCollection = CarBrandCollection::make(CarBrand::paginate());
        return $this->success($carBrandCollection, 'Список всех брэндов');
    }

    public function show(CarBrand $carBrand): JsonResponse
    {
        $carBrandResource = CarBrandResource::make($carBrand);
        return $this->success($carBrandResource, 'Бренд с id - ' . $carBrand->id);
    }
}
