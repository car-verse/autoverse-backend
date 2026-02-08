<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarImage extends Model
{
    protected $fillable = [
        'car_id',
        'car_image_type_id',
        'image_path',
        'sort_order',
        'is_main',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_main' => 'boolean',
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(CarImageType::class, 'car_image_type_id');
    }
}
