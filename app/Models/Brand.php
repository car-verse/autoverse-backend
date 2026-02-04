<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name', 'country_origin'];

    protected $fillable = [
        'website_url',
    ];
}
