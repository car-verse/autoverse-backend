<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feature extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name', 'description'];
    protected $fillable = ['slug', 'feature_category_id', 'icon', 'is_premium'];

    protected $casts = [
        'is_premium' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(FeatureCategory::class, 'feature_category_id');
    }
}
