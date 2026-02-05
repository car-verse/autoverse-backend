<?php

namespace App\Filament\Resources\Brands\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class BrandsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->circular()
                    ->width(40)
                    ->height(40),

                TextColumn::make('name')
                    ->label('Brand')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->country_origin),

                TextColumn::make('website_url')
                    ->label('Website')
                    ->url(fn ($record) => $record->website_url, true)
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-globe-alt')
                    ->toggleable(),

                ToggleColumn::make('is_active')
                    ->label('Active')
                    ->onColor('success')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('is_active')
                    ->label('Status')
                    ->native(false)
                    ->options([
                        1 => 'Active',
                        0 => 'Inactive',
                    ]),

                TrashedFilter::make()
                ->native(false),
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make()
                        ->icon('heroicon-o-pencil-square'),

                    DeleteAction::make()
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation()
                        ->modalHeading('Delete Brand')
                        ->modalSubheading('This brand will be soft deleted. You can restore it later.'),
                ])
                ->icon('heroicon-o-ellipsis-vertical'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->icon('heroicon-o-trash')
                        ->modalHeading('Delete selected brands')
                        ->modalSubheading(
                            'This action will soft delete the selected brands.
                             You can restore them later from the trash.'
                        )
                        ->modalButton('Yes, delete'),

                    ForceDeleteBulkAction::make()
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->modalHeading('Permanently delete brands')
                        ->modalSubheading('This action cannot be undone.'),

                    RestoreBulkAction::make()
                        ->icon('heroicon-o-arrow-path'),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
