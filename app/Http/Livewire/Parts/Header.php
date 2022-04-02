<?php

namespace App\Http\Livewire\Parts;

use Livewire\Component;

class Header extends Component
{

    public function toggleNav()
    {
        $this->emit('toggleNav');
    }

    public function render()
    {
        return view('livewire.parts.header');
    }
}
