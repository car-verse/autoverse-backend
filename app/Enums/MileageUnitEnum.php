<?php

namespace App\Enums;

enum MileageUnitEnum: int
{
    case MILES = 1;
    case KILOMETERS = 2;

    public function label(): string
    {
        return match ($this) {
            self::MILES => 'Miles',
            self::KILOMETERS => 'Kilometers',
        };
    }
}
