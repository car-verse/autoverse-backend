<?php

namespace App\Providers\Filament;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        FilamentAsset::register([
            Css::make('rtl-styles', __DIR__ . '/../../../resources/css/rtl.css'),
        ]);
    }
}