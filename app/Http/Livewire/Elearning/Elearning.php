<?php

namespace App\Http\Livewire\Elearning;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Elearning extends Component
{
    public $userType;

    public function mount()
    {
        if(Auth::user()->type == 0 || Auth::user()->type == 1){
            $this->userType = Auth::user()->type;
        } else{
            return redirect(route('home'));
        }
    }

    public function render()
    {
        return view('livewire.elearning.elearning');
    }
}
