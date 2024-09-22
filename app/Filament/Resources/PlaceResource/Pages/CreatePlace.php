<?php

namespace App\Filament\Resources\PlaceResource\Pages;

use App\Filament\Resources\PlaceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Image;
use App\Models\Place;

class CreatePlace extends CreateRecord
{
    protected static string $resource = PlaceResource::class;

    protected function handleRecordCreation(array $data): Place
    {
        // Create the place record
        $place = Place::create($data);
    
        // Handle multiple image uploads
        if (isset($data['images'])) {
            foreach ($data['images'] as $imagePath) {
                // Create the image record
                $image = new Image(['image' => $imagePath]);
                // Associate the image with the place
                $place->images()->save($image);
            }
        }
    
        return $place;
    }
}
