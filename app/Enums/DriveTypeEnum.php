<?php

namespace App\Enums;


enum DriveTypeEnum: int
{
    case FWD = 1;
    case RWD = 2;
    case AWD = 3;
    case FOUR_WD = 4;

    public function label(): string
    {
        return match ($this) {
            self::FWD => 'Front-Wheel Drive',
            self::RWD => 'Rear-Wheel Drive',
            self::AWD => 'All-Wheel Drive',
            self::FOUR_WD => '4-Wheel Drive',
        };
    }
}
