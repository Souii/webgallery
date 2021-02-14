<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository
{
    public function findOrCreate($name)
    {
        return Tag::firstOrCreate(['name' => $name]);
    }
}
