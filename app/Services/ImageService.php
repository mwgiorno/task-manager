<?php

namespace App\Services;

use Intervention\Image\Facades\Image;

class ImageService 
{
    public static function createThumbnail($path)
    {
        $thumbnail = Image::make($path);

        if($thumbnail->height() > $thumbnail->width()) {
            $thumbnail->resize(150,null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $thumbnail->resize(null,150, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $thumbnail->crop(150, 150);
        
        $thumbnail->save(null, null, 'jpg');
    }
}