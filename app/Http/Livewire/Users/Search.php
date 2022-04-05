<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;

class Search extends Component
{
    public $users, $search;
    public $pageStatu = 0;

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
        $this->users = User::where('identifiant', $this->search)->where('type', 0)->get();
        $this->pageStatu = 1;
    }


    public function render()
    {
        return view('livewire.users.search');
    }
}
