<?php

namespace App\Http\Livewire\Moderator;

use Livewire\Component;

class Suspendre extends Component
{
    public $user;
    public function suspendre()
    {

        $this->user->update([
            'statu' => 3
        ]);
        $this->emit('userSuspendre');
    }

    public function mount($user)
    {
        $this->user = $user;
    }
    public function render()
    {
        return view('livewire.moderator.suspendre');
    }
}
