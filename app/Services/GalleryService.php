<?php

namespace App\Services;

use App\Repositories\ImageRepository;

class GalleryService
{
    private $images;
    private $fileService;
    private $tagService;

    public function __construct(
        ImageRepository $images,
        ImageFileService $fileService,
        TagService $tagService
    ) {
        $this->images = $images;
        $this->fileService = $fileService;
        $this->tagService = $tagService;
    }

    public function addImage(array $data)
    {
        $data['original'] = $this->fileService->storeOriginal($data['file']);
        $data['thumbnail'] = $this->fileService->createThumbnail($data['file']);

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

    public function removeImage($id)
    {
        $image = $this->images->find($id);

        $this->fileService->remove($image->original);
        $this->fileService->remove($image->thumbnail);

        $image->tags()->detach();
        $this->images->remove($id);
    }
}
