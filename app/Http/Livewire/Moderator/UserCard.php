<?php

namespace App\Http\Livewire\Moderator;

use App\Models\User;
use Livewire\Component;

class UserCard extends Component
{
    public $user;

    public function mount($user_id)
    {
        $this->user = User::find($user_id);
    }
    public function render()
    {
        return view('livewire.moderator.user-card');
    }
}
