<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model implements TranslatableContract
{
    use Translatable, SoftDeletes;

    protected $fillable = [
        'website_url',
        'is_active',
        'logo',
    ];

    public $translatedAttributes = ['name', 'country_origin'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}