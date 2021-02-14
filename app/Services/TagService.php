<?php

namespace App\Services;

use App\Models\Tag;
use App\Repositories\TagRepository;

class TagService
{
    private $converter;
    private $tags;

    public function __construct(TagConverter $converter, TagRepository $tags)
    {
        $this->converter = $converter;
        $this->tags = $tags;
    }

    public function defineTags($tags)
    {
        $tagNames = $this->converter->convertFromString($tags);
        $tagIds = [];

        foreach ($tagNames as $tagName) {
            $tag = $this->tags->findOrCreate($tagName);

            if ($tag) {
                $tagIds[] = $tag->id;
            }
        }

        return $tagIds;
    }
}
