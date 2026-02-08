<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WarrantyTerm extends Model
{
    protected $fillable = [
        'warranty_type_id',
        'years',
        'miles',
        'is_unlimited_miles',
    ];

    protected $casts = [
        'is_unlimited_miles' => 'boolean',
        'years' => 'integer',
        'miles' => 'integer',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(WarrantyType::class, 'warranty_type_id');
    }
}
