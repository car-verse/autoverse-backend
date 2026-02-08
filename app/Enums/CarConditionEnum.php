<?php

namespace App\Enums;


enum CarConditionEnum: int
{
    case NEW = 1;
    case EXCELLENT = 2;
    case GOOD = 3;
    case FAIR = 4;
    case SALVAGE = 5;

    public function label(): string
    {
        return match ($this) {
            self::NEW => 'New',
            self::EXCELLENT => 'Excellent',
            self::GOOD => 'Good',
            self::FAIR => 'Fair',
            self::SALVAGE => 'Salvage',
        };
    }
}
