<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Gallery extends Component
{
    public $categories;
    public $header;
    public $admin;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categories, $header, $admin)
    {
        $this->categories = $categories;
        $this->header = $header;
        $this->admin = $admin;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.gallery');
    }
}
