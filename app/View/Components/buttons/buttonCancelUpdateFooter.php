<?php

namespace App\View\Components\buttons;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class buttonCancelUpdateFooter extends Component
{
    public $asset;
    public $hrefroute;
    public $updatewhat;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($hrefroute, $asset, $updatewhat)
    {
        $this->asset = $asset;
        $this->hrefroute = $hrefroute;
        $this->updatewhat = $updatewhat;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.buttons.buttonCancelUpdateFooter');
    }
}
