<?php

namespace App\Enums;


enum TitleStatusEnum: int 
{
    case CLEAN = 1;
    case SALVAGE = 2;
    case REBUILT = 3;
    case LEMON = 4;
    case FLOOD_DAMAGE = 5;
    case LIEN_HOLDER = 6;
    case MISSING = 7;

    public function label(): string
    {
        return match ($this) {
            self::CLEAN => 'Clean',
            self::SALVAGE => 'Salvage',
            self::REBUILT => 'Rebuilt',
            self::LEMON => 'Lemon',
            self::FLOOD_DAMAGE => 'Flood Damage',
            self::LIEN_HOLDER => 'Lien Holder',
            self::MISSING => 'Missing',
        };
    }
}
