<?php

namespace App\Enums;

enum FeatureCategoryEnum: int
{
    case SAFETY = 1;
    case COMFORT = 2;
    case PERFORMANCE = 3;
    case ENTERTAINMENT = 4;
    case TECHNOLOGY = 5;
    case INTERIOR = 6;
    case EXTERIOR = 7;
    case OFF_ROAD = 8;

    public function label(): string
    {
        return match ($this) {
            self::SAFETY => 'Safety',
            self::COMFORT => 'Comfort',
            self::PERFORMANCE => 'Performance',
            self::ENTERTAINMENT => 'Entertainment',
            self::TECHNOLOGY => 'Technology',
            self::INTERIOR => 'Interior',
            self::EXTERIOR => 'Exterior',
            self::OFF_ROAD => 'Off-Road',
        };
    }
}
