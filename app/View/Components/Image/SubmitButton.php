<?php

namespace App\View\Components\Image;

use Illuminate\View\Component;

class SubmitButton extends Component
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.image.submit-button');
    }
}
