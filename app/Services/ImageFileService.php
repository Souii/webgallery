<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Imagick;

class ImageFileService
{
    const ORIGINAL_PATH = 'public/images';
    const THUMBNAIL_PATH = 'public/thumbnails';

    private $pathResolver;

    public function __construct(PublicPathResolver $pathResolver)
    {
        $this->pathResolver = $pathResolver;
    }

    private function store($path, $file)
    {
        return Storage::putFile($path, $file);
    }

    public function storeOriginal($file)
    {
        $path = $this->store(self::ORIGINAL_PATH, $file);

        return $this->pathResolver->trim($path);
    }

    public function createThumbnail($file)
    {
        $thumbnail = $this->store(self::THUMBNAIL_PATH, $file);
        $source = Storage::path($thumbnail);

        $imagick = new Imagick($source);
        $imagick->adaptiveResizeImage(500, 0);
        $imagick->writeImage($source);

        return $this->pathResolver->trim($thumbnail);
    }

    public function remove($file)
    {
        $path = $this->pathResolver->append($file);

        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }
}
