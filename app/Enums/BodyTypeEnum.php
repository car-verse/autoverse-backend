<?php

namespace App\Enums;

enum BodyTypeEnum: int
{
    case SEDAN = 1;
    case SUV = 2;
    case COUPE = 3;
    case HATCHBACK = 4;
    case CONVERTIBLE = 5;
    case WAGON = 6;
    case TRUCK = 7;
    case VAN = 8;
    case MINIVAN = 9;

    public function label(): string
    {
        return match ($this) {
            self::SEDAN => 'Sedan',
            self::SUV => 'SUV',
            self::COUPE => 'Coupe',
            self::HATCHBACK => 'Hatchback',
            self::CONVERTIBLE => 'Convertible',
            self::WAGON => 'Wagon',
            self::TRUCK => 'Truck',
            self::VAN => 'Van',
            self::MINIVAN => 'Minivan',
        };
    }
}
