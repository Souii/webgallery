<?php

namespace App\View\Components\Image;

use Illuminate\View\Component;

class Form extends Component
{
    public $route;
    public $action;
    public $categories;
    public $imageData;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $action, $categories, $imageData)
    {
        $this->route = $route;
        $this->action = $action;
        $this->categories = $categories;
        $this->imageData = $imageData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.image.form');
    }
}
