<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavigationUser extends Component
{
    public $navigation_user = false;

    public function render()
    {
        return view('livewire.navigation-user');
    }

    public function toggleItems()
    {
        $this->navigation_user = (! $this->navigation_user);
    }
}
