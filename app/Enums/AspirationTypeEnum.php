<?php

namespace App\Enums;

enum AspirationTypeEnum: int
{
    case NATURALLY_ASPIRATED = 1;
    case TURBOCHARGED = 2;
    case SUPERCHARGED = 3;
    case TWIN_TURBO = 4;
    case ELECTRIC = 5;

    public function label(): string
    {
        return match ($this) {
            self::NATURALLY_ASPIRATED => 'Naturally Aspirated',
            self::TURBOCHARGED => 'Turbocharged',
            self::SUPERCHARGED => 'Supercharged',
            self::TWIN_TURBO => 'Twin Turbo',
            self::ELECTRIC => 'Electric Motor',
        };
    }
}
