<?php

namespace App\Filament\Resources\Brands\Pages;

use App\Filament\Resources\Brands\BrandResource;
use App\Models\BrandTranslation;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateBrand extends CreateRecord
{
    protected static string $resource = BrandResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Keep only non-translatable fields
        $cleanData = [];
        
        foreach ($data as $key => $value) {
            // Skip translatable fields - they'll be handled by handleRecordCreation
            if (!in_array($key, ['name', 'country_origin'])) {
                $cleanData[$key] = $value;
            }
        }
        
        return $cleanData;
    }

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            // Get original form data with translations
            $formData = $this->form->getState();
            
            // Create the main brand record (only non-translatable fields)
            $brand = static::getModel()::create([
                'website_url' => $data['website_url'] ?? null,
                'is_active' => $data['is_active'] ?? true,
            ]);
            
            // Define translatable fields
            $translatableFields = ['name', 'country_origin'];
            
            // Create translation records for each locale
            foreach (['en', 'ar'] as $locale) {
                $translationData = [];
                
                // Extract values for this locale from each translatable field
                foreach ($translatableFields as $field) {
                    if (isset($formData[$field][$locale])) {
                        $translationData[$field] = $formData[$field][$locale];
                    }
                }
                
                // Only create if we have translation data
                if (!empty($translationData)) {
                    BrandTranslation::create([
                        'brand_id' => $brand->id,        // 👈 Add this
                        'locale' => $locale,              // 👈 Add this
                        ...$translationData,              // 👈 Spread the rest
                    ]);
                }
            }
            
            // Refresh to load translations
            $brand->refresh();
            
            return $brand;
        });
    }
}
