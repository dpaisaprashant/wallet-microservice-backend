<?php

namespace App\Traits;

use App\Models\User;
use Carbon\Carbon;

/**
 * Relation for the user
 */
trait UploadImage
{
    public function uploadImage($image, $imageFieldName, $path )
    {
        $extension = $image[$imageFieldName]->getClientOriginalExtension();

        $filename = $imageFieldName . '_' . Carbon::now()->timestamp . '.' . $extension;

        $image[$imageFieldName]->move(storage_path($path), $filename );

        return $filename;
    }

    public function uploadImageBase64($image, $imagePath = null)
    {
        if (empty($imagePath)) $imagePath = asset('/storage/uploads/frontend/');
        $img = file_get_contents($imagePath . '/' . $image);

        return base64_encode($img);
    }

    public function uploadedImageDimensions($image, $imagePath = null)
    {
        if (empty($imagePath)) $imagePath = asset('/storage/uploads/frontend/');
        $img = $imagePath . '/' . $image;
        $imageData = getimagesize($img);
        return [
            'width' => $imageData[0],
            'height' => $imageData[1]
        ];
    }
}
