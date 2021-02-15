<?php

namespace App\Services;

use App\Repositories\ImageRepository;
use App\Services\ImageStorage\ImageStorage;

class GalleryService
{
    private $images;
    private $storage;
    private $thumnail;
    private $tagService;

    public function __construct(
        ImageRepository $images,
        ImageStorage $storage,
        ThumbnailService $thumnail,
        TagService $tagService
    ) {
        $this->images = $images;
        $this->storage = $storage;
        $this->thumnail = $thumnail;
        $this->tagService = $tagService;
    }

    public function addImage(array $data)
    {
        $data['original'] = $this->storage->storeOriginal($data['file']);
        $this->thumnail->create(($data['file'])->path());
        $data['thumbnail'] = $this->storage->storeThumbnail($data['file']);

        $image = $this->images->save($data);
        $tags = $this->tagService->defineTags($data['tags']);

        $image->tags()->attach($tags);
    }

    public function updateMetadata($id, array $data)
    {
        $image = $this->images->update($id, $data);

        $tags = $this->tagService->defineTags($data['tags']);
        $image->tags()->sync($tags);
    }

    public function deleteImage($id)
    {
        $image = $this->images->find($id);

        $this->storage->delete($image->original);
        $this->storage->delete($image->thumbnail);

        $image->tags()->detach();
        $this->images->remove($id);
    }
}
