<?php

namespace App\Http\Livewire\Resources;

use Livewire\Component;
use App\Models\resources\Category;

class Index extends Component
{
    public $newCat = false;
    public $categories;

    protected $listeners = ['refreshCat'];

    public function refreshCat()
    {
        $this->categories = Category::all();
        $this->newCat = false;
    }

    public function newCatForm()
    {
        $this->newCat = !$this->newCat;
    }

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.resources.index');
    }
}
