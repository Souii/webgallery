<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getAll()
    {
        return Category::all();
    }

    public function save(array $data)
    {
        Category::new($data['name']);
    }
}
