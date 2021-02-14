<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Image;

class ImageRepository
{
    const PER_PAGE = 6;

    public function save(array $data)
    {
        return Image::new(
            $data['original'],
            $data['thumbnail'],
            $data['category'],
            $data['title'],
            $data['description']
        );
    }

    public function update($id, array $data)
    {
        $image = $this->find($id);

        $image->fill([
            'category_id' => $data['category'],
            'title' => $data['title'],
            'description' => $data['description']
        ]);
        $image->save();

        return $image;
    }

    public function find($id)
    {
        return Image::findOrFail($id);
    }

    public function remove($id)
    {
        Image::where('id', $id)->delete();
    }

    public function getFiltered($filters, $page)
    {
        $images = Image::whereHas(
            'category',
            function (Builder $query) use($filters) {
                if ($filters['category']) {
                    $query->where('name', $filters['category']);
                }
            }
        )-> whereHas(
            'tags',
            function (Builder $query) use($filters) {
                if ($filters['tag']) {
                    $query->where('name', $filters['tag']);
                }
            }
        )->limit($page * static::PER_PAGE)->latest()->get();

        return $images;
    }
}
