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
        
        $formData = [
            'website_url' => $brand->website_url,
            'is_active' => $brand->is_active,
            'logo' => $brand->logo,
            'founded' => $brand->founded,
            'popularity_score' => $brand->popularity_score,
            'country_origin' => $brand->country_origin,
        ];
        
        $translations = BrandTranslation::where('brand_id', $brand->id)->get();
        
        $translatableFields = ['name'];
        
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
        $cleanData = [];
        
        foreach ($data as $key => $value) {
            if (!in_array($key, ['name'])) {
                $cleanData[$key] = $value;
            }
        }
        
        return $cleanData;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return DB::transaction(function () use ($record, $data) {
            $formData = $this->form->getState();
            
            $record->update([
                'website_url' => $data['website_url'] ?? null,
                'is_active' => $data['is_active'] ?? true,
                'logo' => $data['logo'] ?? null,
                'founded' => (int) $formData['founded'] ?? null,
                'popularity_score' => (int) $formData['popularity_score'] ?? 0,
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
                    BrandTranslation::updateOrCreate(
                        [
                            'brand_id' => $record->id,
                            'locale' => $locale,
                        ],
                        $translationData
                    );
                }
            }
            
            $record->refresh();
            
            return $record;
        });
    }
}
