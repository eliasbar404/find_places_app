<?php

namespace App\Filament\Resources\PlaceResource\Pages;

use App\Filament\Resources\PlaceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Image;
use App\Models\Place;

class EditPlace extends EditRecord
{
    protected static string $resource = PlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }


    protected function mutateFormDataBeforeSave(array $data): array
    {
        $place = $this->record; // Get the existing place record
    
        // Update place data (excluding images, which we handle separately)
        $place->update($data);
    
        // Handle image updates
        if (isset($data['images'])) {
            // Remove existing images if necessary
            if (count($place->images) > 0) {
                foreach ($place->images as $existingImage) {
                    $existingImage->delete(); // Remove existing images
                }
            }
    
            // Attach new images
            foreach ($data['images'] as $imagePath) {
                // Create the Image record
                $image = new Image(['image' => $imagePath]);
    
                // Associate the image with the place
                $place->images()->save($image);
            }
        }
    
        // Return the modified form data (without the images, as they're already handled)
        unset($data['images']);
    
        return $data;
    }
}
