<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarCollection;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function index()
    {
        return new CarCollection(
            Car::with('carModel.carBrand', 'user')
                ->where('user_id', Auth::id())
                ->paginate()
        );
    }

    public function show(Car $Car)
    {
        return new CarResource($Car->load('carModel.carBrand', 'user'));

    }

}
