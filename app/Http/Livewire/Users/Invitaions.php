<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class Invitaions extends Component
{
    public $search;
    public $pageStatu = 0;
    public $users;

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
        $this->pageStatu = 2; //1=invitation 2=search
        $this->users = User::where('identifiant', $this->search)->where('type', 0)->get();
    }
    public function mount()
    {
        if (Auth::user()->type != 0) {
            return redirect('/');
        }
        $this->users = User::latest()->whereRelation('invitations', 'receiver', Auth::id())->get();;
    }
    public function render()
    {
        return view('livewire.users.invitaions');
    }
}
