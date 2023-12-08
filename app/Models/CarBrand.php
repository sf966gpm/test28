<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarBrand extends Model
{
    use HasFactory;

    protected $table = 'car_brands';
    protected $fillable = [
        'name',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function carModel(): HasMany
    {
        return $this->hasMany(CarModel::class, 'car_brand_id', 'id');
    }


//    public function car(): HasMany
//    {
//        return $this->hasMany(Car::class, 'car_brand_id', 'id');
//    }
}
