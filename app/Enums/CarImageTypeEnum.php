<?php

namespace App\Enums;


enum CarImageTypeEnum: int
{
    case EXTERIOR_FRONT = 1;
    case EXTERIOR_REAR = 2;
    case EXTERIOR_SIDE = 3;
    case INTERIOR_DASHBOARD = 4;
    case INTERIOR_SEATS = 5;
    case ENGINE_BAY = 6;
    case TRUNK = 7;
    case WHEEL = 8;
    case OTHER = 9;

    public function label(): string
    {
        return match ($this) {
            self::EXTERIOR_FRONT => 'Exterior Front',
            self::EXTERIOR_REAR => 'Exterior Rear',
            self::EXTERIOR_SIDE => 'Exterior Side',
            self::INTERIOR_DASHBOARD => 'Interior Dashboard',
            self::INTERIOR_SEATS => 'Interior Seats',
            self::ENGINE_BAY => 'Engine Bay',
            self::TRUNK => 'Trunk',
            self::WHEEL => 'Wheel',
            self::OTHER => 'Other',
        };
    }
}
