<?php

namespace App\Services\ImageStorage;

use Illuminate\Support\Facades\Storage;

class AmazonStorage extends ImageStorage
{
    public function store($path, $file)
    {
        return Storage::disk('s3')->put($path, $file, 'public');
    }

    public function storeOriginal($file)
    {
        return $this->store(static::ORIGINAL, $file);
    }

    public function storeThumbnail($file)
    {
        return $this->store(static::THUMBNAIL, $file);
    }

    public function delete($file)
    {
        if (Storage::disk('s3')->exists($file)) {
            Storage::disk('s3')->delete($file);
        }
    }
}
