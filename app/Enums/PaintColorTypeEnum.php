<?php

namespace App\Enums;

enum PaintColorTypeEnum: int 
{
    case SOLID = 1;
    case METALLIC = 2;
    case PEARL = 3;
    case MATTE = 4;
    case GLOSS = 5;
    case SATIN = 6;

    public function label(): string
    {
        return match ($this) {
            self::SOLID => 'Solid',
            self::METALLIC => 'Metallic',
            self::PEARL => 'Pearl',
            self::MATTE => 'Matte',
            self::GLOSS => 'Gloss',
            self::SATIN => 'Satin',
        };
    }
}
