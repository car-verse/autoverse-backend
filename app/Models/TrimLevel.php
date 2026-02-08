<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TrimLevel extends Model implements TranslatableContract
{
    use Translatable, SoftDeletes;

    public $translatedAttributes = ['name', 'description'];
    protected $fillable = [
        'car_model_id',
        'slug',
        'year_start',
        'year_end',
        'msrp',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'year_start' => 'integer',
        'year_end' => 'integer',
        'msrp' => 'decimal:2',
        'sort_order' => 'integer',
    ];

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    public function specifications(): HasOne
    {
        return $this->hasOne(CarSpecification::class);
    }

    public function features(): HasMany
    {
        return $this->hasMany(FeatureTrimLevel::class);
    }
}
