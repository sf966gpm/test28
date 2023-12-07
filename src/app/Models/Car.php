<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';
    protected $fillable = [
        'name',
        'car_brand_id',
        'vehicle_year',
        'mileage',
        'color',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'car_brand_id' => 'integer'
    ];

//    public function carBrand(): BelongsTo
//    {
//        return $this->belongsTo(CarBrand::class, 'car_brand_id', 'id');
//    }

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class, 'car_model_id', 'id');
    }
}
