<?php

namespace App\Enums;

enum VehicleCategoryEnum: int
{
    case ECONOMY = 1;
    case LUXURY = 2;
    case SPORTS = 3;
    case OFF_ROAD = 4;
    case COMMERCIAL = 5;
    case ELECTRIC = 6;
    case VINTAGE = 7;

    public function label(): string
    {
        return match ($this) {
            self::ECONOMY => 'Economy',
            self::LUXURY => 'Luxury',
            self::SPORTS => 'Sports',
            self::OFF_ROAD => 'Off-Road',
            self::COMMERCIAL => 'Commercial',
            self::ELECTRIC => 'Electric',
            self::VINTAGE => 'Vintage',
        };
    }
}
