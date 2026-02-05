<?php

namespace App\Support;

class CarManufacturingCountries
{
    protected static array $flagCodes = [
        'JP' => 'jp',
        'KR' => 'kr',
        'CN' => 'cn',
        'IN' => 'in',
        'MY' => 'my',
        'IR' => 'ir',
        'TH' => 'th',
        'ID' => 'id',

        'DE' => 'de',
        'FR' => 'fr',
        'IT' => 'it',
        'GB' => 'gb',
        'SE' => 'se',
        'CZ' => 'cz',
        'ES' => 'es',
        'RO' => 'ro',
        'RU' => 'ru',
        'UA' => 'ua',
        'HU' => 'hu',
        'NL' => 'nl',
        'AT' => 'at',

        'US' => 'us',
        'CA' => 'ca',
        'MX' => 'mx',

        'BR' => 'br',
        'AR' => 'ar',

        'TR' => 'tr',
    ];

    public static function all(): array
    {
        return [
            'JP' => ['en' => 'Japan', 'ar' => 'اليابان'],
            'KR' => ['en' => 'South Korea', 'ar' => 'كوريا الجنوبية'],
            'CN' => ['en' => 'China', 'ar' => 'الصين'],
            'IN' => ['en' => 'India', 'ar' => 'الهند'],
            'MY' => ['en' => 'Malaysia', 'ar' => 'ماليزيا'],
            'IR' => ['en' => 'Iran', 'ar' => 'إيران'],
            'TH' => ['en' => 'Thailand', 'ar' => 'تايلاند'],
            'ID' => ['en' => 'Indonesia', 'ar' => 'إندونيسيا'],

            'DE' => ['en' => 'Germany', 'ar' => 'ألمانيا'],
            'FR' => ['en' => 'France', 'ar' => 'فرنسا'],
            'IT' => ['en' => 'Italy', 'ar' => 'إيطاليا'],
            'GB' => ['en' => 'United Kingdom', 'ar' => 'المملكة المتحدة'],
            'SE' => ['en' => 'Sweden', 'ar' => 'السويد'],
            'CZ' => ['en' => 'Czech Republic', 'ar' => 'التشيك'],
            'ES' => ['en' => 'Spain', 'ar' => 'إسبانيا'],
            'RO' => ['en' => 'Romania', 'ar' => 'رومانيا'],
            'RU' => ['en' => 'Russia', 'ar' => 'روسيا'],
            'UA' => ['en' => 'Ukraine', 'ar' => 'أوكرانيا'],
            'HU' => ['en' => 'Hungary', 'ar' => 'المجر'],
            'NL' => ['en' => 'Netherlands', 'ar' => 'هولندا'],
            'AT' => ['en' => 'Austria', 'ar' => 'النمسا'],

            'US' => ['en' => 'United States', 'ar' => 'الولايات المتحدة'],
            'CA' => ['en' => 'Canada', 'ar' => 'كندا'],
            'MX' => ['en' => 'Mexico', 'ar' => 'المكسيك'],

            'BR' => ['en' => 'Brazil', 'ar' => 'البرازيل'],
            'AR' => ['en' => 'Argentina', 'ar' => 'الأرجنتين'],

            'TR' => ['en' => 'Turkey', 'ar' => 'تركيا'],
        ];
    }

    public static function options(?string $locale = null): array
    {
        $locale = $locale ?? app()->getLocale();
        
        return collect(self::all())
            ->mapWithKeys(fn ($value, $key) => [
                $key => self::formatOption($key, $value[$locale]),
            ])
            ->toArray();
    }

    protected static function formatOption(string $code, string $name): string
    {
        $flagCode = strtolower(self::$flagCodes[$code] ?? $code);
        $flagUrl = "https://flagcdn.com/w40/{$flagCode}.png";
        
        return <<<HTML
            <div style="display: flex; align-items: center; gap: 10px;">
                <img src="{$flagUrl}" alt="{$code}" style="width: 28px; height: 20px; object-fit: cover; border-radius: 2px; box-shadow: 0 1px 3px rgba(0,0,0,0.2);">
                <span>{$name}</span>
            </div>
        HTML;
    }
}