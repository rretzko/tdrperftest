<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class testAlert extends Component
{
    public $hrefroute;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($hrefroute)
    {
        $this->hrefroute = $hrefroute;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.test-alert');
    }
}
