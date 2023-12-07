<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Collection;

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

        $users = User::factory($userCount)->create();
        $usersIDs = $this->getUsersIDs($users);

        $carBrands = CarBrand::factory(10)->create();

        $carModels = $this->generateCarModels($carBrands, intdiv($userCount, 10));

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
     * Отдаем масивом все ключи Users
     * @param Collection $users
     * @return array
     */
    private function getUsersIDs(Collection $users): array
    {
        return $users->pluck('id')->toArray();
    }

    /**
     * На основе брендов $times раз генерируем CarModels
     * @param Collection $carBrands
     * @param int $times
     * @return Collection
     */
    private function generateCarModels(Collection $carBrands, int $times): Collection
    {
        $carModels = new Collection();
        for ($i = 1; $i <= $times; $i++) {
            $carBrandsCollection = $carBrands->each(function ($carBrand) {
                CarModel::create([
                    'name' => fake()->unique()->sentence(),
                    'car_brand_id' => $carBrand->id,
                ]);
            });
            foreach ($carBrandsCollection as $brand) {
                $carModels = $carModels->push(...$brand->carModel);
            }
        }
        return $carModels;
    }
}
