<?php

namespace App\Services;

class PublicPathResolver
{
    public function trim($path)
    {
        return str_replace('public/', '', $path);
    }

    public function append($path)
    {
        return "public/$path";
    }
}
