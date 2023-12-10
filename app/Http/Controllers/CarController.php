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

    public function index(): CarCollection
    {
        return CarCollection::make(
            Car::with('carModel.carBrand', 'user')
                ->where('user_id', Auth::id())
                ->paginate()
        );
    }

    public function show(Car $car): CarResource
    {
        $this->authorize('view', $car);

        return CarResource::make($car->load('user', 'carModel.carBrand'));
    }

    public function store(StoreCarRequest $request, CarService $carService): JsonResponse
    {
        $validated = $request->validated();

        $car = $carService->createCar($validated);
        return CarResource::make($car)
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateCarRequest $request, Car $car, CarService $carService): CarResource
    {
        $this->authorize('update', $car);

        $validated = $request->validated();


        $car = $carService->updateCar($validated, $car->load('user', 'carModel.carBrand'));
        return CarResource::make($car);
    }

    public function destroy(Car $car): JsonResponse
    {
        $this->authorize('delete', $car);

        $car->delete();
        return $this->success('', 'Машина была удалена из базы');
    }

}
