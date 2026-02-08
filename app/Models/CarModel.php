<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarModel extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name', 'description'];
    protected $fillable = [
        'brand_id',
        'slug',
        'body_type_id',
        'vehicle_category_id',
        'year_start',
        'year_end',
        'official_image_url',
        'base_msrp',
        'is_active',
        'popularity_score',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'year_start' => 'integer',
        'year_end' => 'integer',
        'base_msrp' => 'decimal:2',
        'popularity_score' => 'integer',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function bodyType(): BelongsTo
    {
        return $this->belongsTo(BodyType::class);
    }

    public function vehicleCategory(): BelongsTo
    {
        return $this->belongsTo(VehicleCategory::class);
    }

    public function trimLevels(): HasMany
    {
        return $this->hasMany(TrimLevel::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForYear($query, $year)
    {
        return $query->where('year_start', '<=', $year)
            ->where(function($q) use ($year) {
                $q->whereNull('year_end')
                  ->orWhere('year_end', '>=', $year);
            });
    }
}
