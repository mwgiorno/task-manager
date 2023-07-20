<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublicImageStorage 
{
    const PREFIX = '/storage';

    public static function store($file, $directory = 'images')
    {
        return Storage::disk('public')->putFile($directory, $file);
    }

    public static function delete($path)
    {
        Storage::disk('public')->delete($path);
    }

    public static function getPathFromUrl($url)
    {
        return Str::remove(static::PREFIX, $url);
    }
}