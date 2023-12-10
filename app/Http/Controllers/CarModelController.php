<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarModelCollection;
use App\Http\Resources\CarModelResource;
use App\Models\CarModel;
use Illuminate\Http\JsonResponse;

class CarModelController extends Controller
{
    //avoid sending a request with relations to the database inside the resource

    public function index(): JsonResponse
    {
        $carModelCollection = CarModelCollection::make(CarModel::with('carBrand')->paginate());
        return $this->success($carModelCollection, 'Список все моделей');
    }

    public function show(CarModel $carModel): JsonResponse
    {
        $carModelResource = CarModelResource::make($carModel->load('carBrand'));
        return $this->success($carModelResource, 'Модель с id - ' . $carModel->id);
    }
}
