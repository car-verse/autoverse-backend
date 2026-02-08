<?php

namespace App\Enums;

enum FuelTypeEnum: int 
{
    case GASOLINE = 1;
    case DIESEL = 2;
    case ELECTRIC = 3;
    case HYBRID = 4;
    case PLUG_IN_HYBRID = 5;
    case HYDROGEN = 6;
    case FLEX_FUEL = 7;

    public function label(): string
    {
        return match ($this) {
            self::GASOLINE => 'Gasoline',
            self::DIESEL => 'Diesel',
            self::ELECTRIC => 'Electric',
            self::HYBRID => 'Hybrid',
            self::PLUG_IN_HYBRID => 'Plug-in Hybrid',
            self::HYDROGEN => 'Hydrogen',
            self::FLEX_FUEL => 'Flex Fuel',
        };
    }
}
