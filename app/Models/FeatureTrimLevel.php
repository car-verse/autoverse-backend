<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FeatureTrimLevel extends Pivot
{
    protected $table = 'feature_trim_level';

    protected $fillable = [
        'trim_level_id',
        'feature_id',
        'feature_availability_id',
        'feature_package_id',
        'additional_cost',
    ];

    protected $casts = [
        'additional_cost' => 'decimal:2',
    ];
}
