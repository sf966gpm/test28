<?php

namespace Database\Seeders;

use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $start = microtime(true);
        $userCount = 500;
        $this->seedApi($userCount);
        $this->command->info('Seeding end in ' . microtime(true) - $start . ' seconds');
    }

    /**
     * Заполняет фейковыми данными таблицы и их связи
     *
     * (Лучшее что я смог придумать)
     * @param int $userCount
     * @return void
     */
    private function seedApi(int $userCount): void
    {
        CarBrand::factory()
            ->count(10)
            ->create()
            ->each(function (CarBrand $carBrand) {
                CarModel::factory()
                    ->count(3)
                    ->create([
                        'car_brand_id' => $carBrand->id,
                    ]);
            });

        $carModelsIDs = CarModel::pluck('id');

        User::factory()
            ->count($userCount)
            ->create()
            ->each(function (User $user) use ($carModelsIDs) {
                Car::factory()
                    ->count(2)
                    ->create([
                        'car_model_id' => fake()->randomElement($carModelsIDs),
                        'user_id' => $user
                    ]);
            });
    }

}
