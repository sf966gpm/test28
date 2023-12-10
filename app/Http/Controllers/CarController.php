<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Resources\CarCollection;
use App\Http\Resources\CarResource;
use App\Models\Car;

use App\Services\CarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{

    public function index(): JsonResponse
    {
        $carCollection = CarCollection::make(
            Car::with('carModel.carBrand', 'user')
                ->where('user_id', Auth::id())
                ->paginate()
        );
        return $this->success($carCollection, 'Список ваших автомобилей');
    }

    public function show(Car $car): JsonResponse
    {
        $this->authorize('view', $car);

        $carResource = CarResource::make($car->load('user', 'carModel.carBrand'));
        return $this->success($carResource, 'Машина c id - ' . $car->id);
    }

    public function store(StoreCarRequest $request, CarService $carService): JsonResponse
    {
        $validated = $request->validated();

        $car = $carService->createCar($validated);
        return $this->success(CarResource::make($car), 'Машина занесена в базу.', 201);
    }

    public function update(UpdateCarRequest $request, Car $car, CarService $carService): JsonResponse
    {
        $this->authorize('update', $car);

        $validated = $request->validated();


        $car = $carService->updateCar($validated, $car->load('user', 'carModel.carBrand'));
        return $this->success(CarResource::make($car), 'Машина обновлена в базе.');
    }

    public function destroy(Car $car): JsonResponse
    {
        $this->authorize('delete', $car);

        $car->delete();
        return $this->success('', 'Машина была удалена из базы');
    }

}
