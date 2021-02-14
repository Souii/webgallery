<?php

namespace App\View\Components\Image;

use Illuminate\View\Component;

class TagInput extends Component
{
    public $tags;

    public function __construct($tags)
    {
        $this->tags = $tags;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.image.tag-input');
    }
}
