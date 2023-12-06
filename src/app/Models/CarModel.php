<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarModel extends Model
{
    use HasFactory;

    protected $table = 'car_models';
    protected $fillable = [
        'name',
        'car_brand_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'car_brand_id' => 'integer'
    ];

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarBrand::class, 'id', 'car_brand_id');
    }
}
