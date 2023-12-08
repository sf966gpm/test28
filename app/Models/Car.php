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
        'car_model_id',
        'vehicle_year',
        'mileage',
        'color',
        'user_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'car_model_id' => 'integer',
        'vehicle_year' => 'integer',
        'mileage' => 'integer',
        'user_id' => 'integer',
    ];

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class, 'car_model_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
