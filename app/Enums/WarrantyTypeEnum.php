<?php

namespace App\Enums;

enum WarrantyTypeEnum: int
{
    case BASIC = 1;
    case POWERTRAIN = 2;
    case CORROSION = 3;
    case ROADSIDE_ASSISTANCE = 4;
    case EMISSIONS = 5;
    case HYBRID_COMPONENT = 6;
    case EV_BATTERY = 7;

    public function label(): string
    {
        return match ($this) {
            self::BASIC => 'Basic',
            self::POWERTRAIN => 'Powertrain',
            self::CORROSION => 'Corrosion',
            self::ROADSIDE_ASSISTANCE => 'Roadside Assistance',
            self::EMISSIONS => 'Emissions',
            self::HYBRID_COMPONENT => 'Hybrid Component',
            self::EV_BATTERY => 'EV Battery',
        };
    }
}
