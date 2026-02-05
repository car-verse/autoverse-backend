<?php

namespace App\Filament\Resources\Brands\Pages;

use App\Filament\Resources\Brands\BrandResource;
use App\Models\BrandTranslation;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class EditBrand extends EditRecord
{
    protected static string $resource = BrandResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

     protected function mutateFormDataBeforeFill(array $data): array
    {
        $brand = $this->record;
        
        // Start with non-translatable fields
        $formData = [
            'website_url' => $brand->website_url,
            'is_active' => $brand->is_active,
            'logo' => $brand->logo,
        ];
        
        // Load all translations
        $translations = BrandTranslation::where('brand_id', $brand->id)->get();
        
        // Define translatable fields
        $translatableFields = ['name', 'country_origin'];
        
        // Transform from: [locale => [field => value]]
        // To: [field => [locale => value]]
        foreach ($translatableFields as $field) {
            $formData[$field] = [];
            
            foreach (['en', 'ar'] as $locale) {
                $translation = $translations->where('locale', $locale)->first();
                $formData[$field][$locale] = $translation->{$field} ?? '';
            }
        }
        
        return $formData;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Keep only non-translatable fields
        $cleanData = [];
        
        foreach ($data as $key => $value) {
            if (!in_array($key, ['name', 'country_origin'])) {
                $cleanData[$key] = $value;
            }
        }
        
        return $cleanData;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return DB::transaction(function () use ($record, $data) {
            // Get original form data with translations
            $formData = $this->form->getState();
            
            // Update main brand record
            $record->update([
                'website_url' => $data['website_url'] ?? null,
                'is_active' => $data['is_active'] ?? true,
                'logo' => $data['logo'] ?? null,
            ]);
            
            // Define translatable fields
            $translatableFields = ['name', 'country_origin'];
            
            // Update or create translations for each locale
            foreach (['en', 'ar'] as $locale) {
                $translationData = [];
                
                // Extract values for this locale from each translatable field
                foreach ($translatableFields as $field) {
                    if (isset($formData[$field][$locale])) {
                        $translationData[$field] = $formData[$field][$locale];
                    }
                }
                
                // Update or create translation
                if (!empty($translationData)) {
                    BrandTranslation::updateOrCreate(
                        [
                            'brand_id' => $record->id,
                            'locale' => $locale,
                        ],
                        $translationData
                    );
                }
            }
            
            // Refresh to load updated translations
            $record->refresh();
            
            return $record;
        });
    }
}
