<?php

namespace App\Services\ImageStorage;

abstract class ImageStorage
{
    public const ORIGINAL = 'images/originals';
    public const THUMBNAIL = 'images/thumbnails';

    abstract public function store($path, $file);
    abstract public function storeOriginal($file);
    abstract public function storeThumbnail($file);
    abstract public function delete($file);
}
