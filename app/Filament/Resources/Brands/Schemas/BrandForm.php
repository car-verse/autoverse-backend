<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use SolutionForest\FilamentTranslateField\Forms\Component\Translate;

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
                                    ->columnSpan(1),

                                TextInput::make('country_origin')
                                    ->label('Country of Origin')
                                    ->placeholder('e.g. Japan')
                                    ->helperText('Country where the brand was founded.')
                                    ->required()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->columnSpan(1),
                            ]),

                        Section::make('Website')
                            ->description('Optional official website link.')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                FileUpload::make('logo')
                                    ->label('Logo')
                                    ->image()
                                    ->openable()
                                    ->downloadable()
                                    ->deletable()
                                    ->disk('public')
                                    ->directory('brands')
                                    ->imagePreviewHeight('350px')
                                    ->imageEditor()
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/webp'])
                                    ->helperText('Upload a PNG or JPG or JPEG or Webp image (max 2MB, recommended 1:1 aspect ratio)')
                                    ->columnSpan('full'),

                                TextInput::make('website_url')
                                    ->label('Website URL')
                                    ->placeholder('https://www.example.com')
                                    ->url()
                                    ->prefixIcon('heroicon-o-link')
                                    ->helperText('Must be a valid URL starting with https://')
                                    ->maxLength(255),
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
