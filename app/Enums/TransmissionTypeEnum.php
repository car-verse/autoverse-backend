<?php

namespace App\Enums;

enum TransmissionTypeEnum: int
{
    case AUTOMATIC = 1;
    case MANUAL = 2;
    case CVT = 3;
    case DUAL_CLUTCH = 4;
    case SEMI_AUTOMATIC = 5;

    public function label(): string
    {
        return match ($this) {
            self::AUTOMATIC => 'Automatic',
            self::MANUAL => 'Manual',
            self::CVT => 'CVT',
            self::DUAL_CLUTCH => 'Dual Clutch',
            self::SEMI_AUTOMATIC => 'Semi-Automatic',
        };
    }
}
