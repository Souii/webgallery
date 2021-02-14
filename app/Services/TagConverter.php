<?php

namespace App\Services;

class TagConverter
{
    public static function convertFromString(string $tags): array
    {
        $converted = collect(explode(',', $tags));
        $converted = $converted->map(function($item) {
            return strtolower(trim($item));
        });

        return $converted->unique()->toArray();
    }
}
