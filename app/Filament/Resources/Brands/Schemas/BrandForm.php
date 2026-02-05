<?php

namespace App\Filament\Resources\Brands\Schemas;

use App\Support\CarManufacturingCountries;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use SolutionForest\FilamentTranslateField\Forms\Component\Translate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Brand Details')
                    ->description('Basic information about the brand in multiple languages.')
                    ->icon('heroicon-o-building-office')
                    ->schema([
                        Translate::make()
                            ->locales(['en', 'ar'])
                            ->columnSpanFull()
                            ->columns(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Brand Name')
                                    ->placeholder('e.g. Toyota')
                                    ->helperText('Displayed publicly. Minimum 3 characters.')
                                    ->required()
                                    ->minLength(3)
                                    ->autofocus()
                                    ->maxLength(100)
                                    ->live(onBlur: true)
                                    ->columnSpan(2),
                            ]),

                        Section::make('Informations & Media')
                            ->description('Optional official website link and brand media.')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                FileUpload::make('logo')
                                    ->label('Brand Logo')
                                    ->image()
                                    ->disk('public')
                                    ->directory('brands')
                                    ->imagePreviewHeight(250)
                                    ->imageEditor()
                                    ->imageCropAspectRatio('1:1')
                                    ->imageResizeTargetWidth(512)
                                    ->imageResizeTargetHeight(512)
                                    ->maxSize(2048)
                                    ->acceptedFileTypes([
                                        'image/png',
                                        'image/jpeg',
                                        'image/jpg',
                                        'image/webp',
                                    ])
                                    ->helperText(
                                        'Square image recommended (1:1). Max size 2MB. ' .
                                        'Uploading a new logo will replace the existing one.'
                                    )
                                    ->hint('PNG or WebP works best for logos')
                                    ->deleteUploadedFileUsing(
                                        fn (?string $file) => $file
                                            ? Storage::disk('public')->delete($file)
                                            : null
                                    ) // delete the physical old file from the firectory when the user remove the file
                                    ->columnSpanFull(),

                                

                                Grid::make(2)
                                    ->schema([
                                        Select::make('country_origin')
                                            ->label('Country')
                                            ->options(fn () => CarManufacturingCountries::options(app()->getLocale()))
                                            ->searchable()
                                            ->prefixIcon('heroicon-o-globe-alt')
                                            ->helperText('Country where the brand was founded.')
                                            ->preload()
                                            ->allowHtml()
                                            ->native(false)
                                            ->required()
                                            ->columnSpan(1),

                                        TextInput::make('founded')
                                            ->label('Founded Year')
                                            ->placeholder('e.g. 1937')
                                            ->numeric()
                                            ->integer()
                                            ->minValue(1800)
                                            ->maxValue(Carbon::now()->year)
                                            ->prefixIcon('heroicon-o-calendar')
                                            ->helperText(
                                                'Enter the year the brand was founded (between 1800 and ' .
                                                Carbon::now()->year . ').'
                                            )
                                            ->validationMessages([
                                                'min' => 'Founded year must be after 1800.',
                                                'max' => 'Founded year cannot be in the future.',
                                            ])
                                            ->columnSpan(1),

                                        
                                    ]),

                                    Grid::make(2)
                                        ->schema([
                                            TextInput::make('popularity_score')
                                            ->label('Popularity Score')
                                            ->placeholder('0 – 100')
                                            ->numeric()
                                            ->integer()
                                            ->minValue(0)
                                            ->maxValue(100)
                                            ->default(0)
                                            ->prefixIcon('heroicon-o-chart-bar')
                                            ->helperText(
                                                'Internal ranking score from 0 to 100. ' .
                                                'Used for sorting and featured listings.'
                                            )
                                            ->validationMessages([
                                                'min' => 'Popularity score cannot be less than 0.',
                                                'max' => 'Popularity score cannot exceed 100.',
                                            ])
                                            ->columnSpan(1),

                                            TextInput::make('website_url')
                                                ->label('Website URL')
                                                ->placeholder('https://www.example.com')
                                                ->url()
                                                ->prefixIcon('heroicon-o-link')
                                                ->helperText('Must be a valid HTTPS URL.')
                                                ->maxLength(255),
                                        ]),
                            ])
                            ->columnSpanFull(),

                        Section::make('Status')
                            ->description('Control whether this brand is visible and usable.')
                            ->icon('heroicon-o-check-circle')
                            ->schema([
                                Toggle::make('is_active')
                                    ->label('Active')
                                    ->inline(false)
                                    ->default(true)
                                    ->helperText(fn (bool $state) =>
                                        $state
                                            ? 'This brand is currently active and visible.'
                                            : 'This brand is disabled and hidden.'
                                    )
                                    ->onColor('success'),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
