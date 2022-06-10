<?php

namespace App\Http\Livewire\Resources;

use Livewire\Component;

class Index extends Component
{
    public $cat;

    public function mount()
    {

    }
    public function render()
    {
        return view('livewire.resources.index');
    }
}
