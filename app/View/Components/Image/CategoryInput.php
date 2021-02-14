<?php

namespace App\View\Components\Image;

use Illuminate\View\Component;

class CategoryInput extends Component
{
    public $categories;
    public $selected;

    public function __construct($categories, $selected)
    {
        $this->categories = $categories;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.image.category-input');
    }
}
