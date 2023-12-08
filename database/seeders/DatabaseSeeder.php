<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;

//use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder
{
    /**
     * Точно нужно переписывать seeder, но пока не нашел красивый способ
     * сидить с такими связями
     */
    public function run(): void
    {

        $start = microtime(true);
        $userCount = 1000;

        $usersIDs = User::factory($userCount)->create()->pluck('id');
        $carBrandsIDs = CarBrand::factory(10)->create()->pluck('id');

        $carModels = $this->generateCarModels(intdiv($userCount, 10), $carBrandsIDs);

        $carModels->each(function ($carModel) use ($usersIDs) {
            Car::create([
                'car_model_id' => $carModel->id,
                'vehicle_year' => fake()->numberBetween(1920, 2023),
                'mileage' => fake()->numberBetween(1, 1000000),
                'color' => fake()->hexColor(),
                'user_id' => fake()->unique()->randomElement($usersIDs)
            ]);
        });
        $this->command->info('Seeding end in ' . microtime(true) - $start . ' seconds');
    }

    /**
     * На основе брендов $times раз генерируем CarModels
     * @param int $times
     * @param Collection $carBrandsIDs
     * @return Collection
     */
    private function generateCarModels(int $times, Collection $carBrandsIDs): Collection
    {
        $carModels = new Collection();
        for ($i = 1; $i <= $times; $i++) {
            for ($j = 1; $j <= count($carBrandsIDs); $j++) {
                $car = CarModel::create([
                    'name' => fake()->unique()->sentence(),
                    'car_brand_id' => fake()->randomElement($carBrandsIDs),
                ]);
                $carModels = $carModels->push($car);
            }
        }
        return $carModels;
    }

}
