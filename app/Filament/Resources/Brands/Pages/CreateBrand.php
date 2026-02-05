<?php

namespace App\Filament\Resources\Brands\Pages;

use App\Filament\Resources\Brands\BrandResource;
use App\Models\BrandTranslation;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateBrand extends CreateRecord
{
    protected static string $resource = BrandResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $cleanData = [];
        
        foreach ($data as $key => $value) {
            if (!in_array($key, ['name'])) {
                $cleanData[$key] = $value;
            }
        }
        
        return $cleanData;
    }

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $formData = $this->form->getState();

            $brand = static::getModel()::create([
                'website_url' => $formData['website_url'] ?? null,
                'is_active' => (int) $formData['is_active'] ?? true,
                'logo' => $formData['logo'] ?? null,
                'founded' => (int) $formData['founded'] ?? null,
                'popularity_score' => (int) $formData['popularity_score'] ?? 0,
                'slug' => Str::slug($formData['name']['en']),
                'country_origin' => $formData['country_origin'],
            ]);
            
            $translatableFields = ['name'];
            
            foreach (['en', 'ar'] as $locale) {
                $translationData = [];
                
                foreach ($translatableFields as $field) {
                    if (isset($formData[$field][$locale])) {
                        $translationData[$field] = $formData[$field][$locale];
                    }
                }

                
                if (!empty($translationData)) {
                    BrandTranslation::create([
                        'brand_id' => $brand->id,
                        'locale' => $locale,
                        ...$translationData,
                    ]);
                }
            }
            
            $brand->refresh();
            
            return $brand;
        });
    }
}
