<?php

namespace App\Enums;


enum FeatureAvailabilityEnum: int
{
    case STANDARD = 1;
    case OPTIONAL = 2;
    case PACKAGE_ONLY = 3;
    case DEALER_INSTALLED = 4;

    public function label(): string
    {
        return match ($this) {
            self::STANDARD => 'Standard',
            self::OPTIONAL => 'Optional',
            self::PACKAGE_ONLY => 'Package Only',
            self::DEALER_INSTALLED => 'Dealer Installed',
        };
    }
}
