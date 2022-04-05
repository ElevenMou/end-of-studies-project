<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Follow extends Component
{
    public $search;
    public $pageStatu = 0; //0=followers 1=following 2=search
    public $users = [];
    public $followingCount = 0, $followersCount = 0;

    protected $rules = [
        'search' => 'required|numeric|max:19999999|min:1999999|'
    ];

    protected $messages = [
        'search.max' => 'Apogée non valid.',
        'search.min' => 'Apogée non valid.',
        'search.numeric' => 'Apogée non valid.'
    ];

    public function searchUser()
    {
        $this->validate();
        $this->pageStatu = 2;
        $this->users = User::where('identifiant', $this->search)->where('type', 0)->get();
    }

    public function mount()
    {
    }
    public function render()
    {
        return view('livewire.users.follow');
    }
}
