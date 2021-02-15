<?php

namespace App\Services\ImageStorage;

use Illuminate\Support\Facades\Storage;

class LocalStorage extends ImageStorage
{
    public function store($path, $file)
    {
        return Storage::disk('public')->put($path, $file);
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
        if (Storage::disk('public')->exists($file)) {
            Storage::disk('public')->delete($file);
        }
    }
}
