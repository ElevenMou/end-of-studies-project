<?php

namespace App\Http\Livewire\Parts;

use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Nav extends Component
{
    public $user, $friendRequest;

    protected $listeners = ['minusInvite'];

    public function minusInvite(){
        $this->friendRequest--;
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('authentification'));
    }

    public function mount()
    {
        if (Auth::check()) {
            $this->user = Auth::user();
            $this->friendRequest = Invitation::where('receiver', $this->user->id)->count();
        }
    }

    public function render()
    {
        return view('livewire.parts.nav');
    }
}
