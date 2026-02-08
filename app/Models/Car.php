<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model implements TranslatableContract
{
    use Translatable, SoftDeletes;

    public $translatedAttributes = ['description'];
    
    protected $fillable = [
        'client_id',
        'showroom_id',
        'brand_id',
        'car_model_id',
        'trim_level_id',
        'year',
        'make',
        'model',
        'trim',
        'vin',
        'price',
        'original_price',
        'price_negotiable',
        'condition_id',
        'mileage',
        'mileage_unit_id',
        'number_of_owners',
        'title_status_id',
        'exterior_color',
        'interior_color',
        'paint_color_id',
        'transmission_type_id',
        'fuel_type_id',
        'drive_type_id',
        'doors',
        'cylinders',
        'engine_size',
        'location_city',
        'location_state',
        'location_zip',
        'latitude',
        'longitude',
        'status_id',
        'listed_at',
        'sold_at',
        'expires_at',
        'views_count',
        'favorites_count',
        'inquiries_count',
        'test_drives_count',
        'is_featured',
        'is_certified',
        'is_verified',
        'has_accident_history',
        'has_service_history',
    ];

    protected $casts = [
        'year' => 'integer',
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'price_negotiable' => 'boolean',
        'mileage' => 'integer',
        'number_of_owners' => 'integer',
        'doors' => 'integer',
        'cylinders' => 'integer',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'listed_at' => 'datetime',
        'sold_at' => 'datetime',
        'expires_at' => 'datetime',
        'views_count' => 'integer',
        'favorites_count' => 'integer',
        'inquiries_count' => 'integer',
        'test_drives_count' => 'integer',
        'is_featured' => 'boolean',
        'is_certified' => 'boolean',
        'is_verified' => 'boolean',
        'has_accident_history' => 'boolean',
        'has_service_history' => 'boolean',
    ];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    public function trimLevel(): BelongsTo
    {
        return $this->belongsTo(TrimLevel::class);
    }

    public function condition(): BelongsTo
    {
        return $this->belongsTo(CarCondition::class);
    }

    public function mileageUnit(): BelongsTo
    {
        return $this->belongsTo(MileageUnit::class);
    }

    public function titleStatus(): BelongsTo
    {
        return $this->belongsTo(TitleStatus::class);
    }

    public function paintColor(): BelongsTo
    {
        return $this->belongsTo(PaintColor::class);
    }

    public function transmissionType(): BelongsTo
    {
        return $this->belongsTo(TransmissionType::class);
    }

    public function fuelType(): BelongsTo
    {
        return $this->belongsTo(FuelType::class);
    }

    public function driveType(): BelongsTo
    {
        return $this->belongsTo(DriveType::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(CarStatus::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(CarImage::class)->orderBy('sort_order');
    }

    public function mainImage()
    {
        return $this->hasOne(CarImage::class)->where('is_main', true);
    }
}
