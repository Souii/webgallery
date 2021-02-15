<?php

namespace App\Services;

use Imagick;

class ThumbnailService
{
    public function create($file)
    {
        $imagick = new Imagick($file);
        $imagick->adaptiveResizeImage(500, 0);
        $imagick->writeImage($file);
    }
}
