<?php

namespace App\Http\Livewire\Users;

use App\Models\Ami;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class Invitaions extends Component
{
    public $search;
    public $pageStatu = 0;
    public $users;
    public $invitationCount, $amisCount;

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
        $this->pageStatu = 2; //0=invitation 1=amis 2=search
        $this->users = User::where('identifiant', $this->search)->where('type', 0)->get();
    }
    public function mount()
    {
        if (Auth::user()->type != 0) {
            return redirect('/');
        }
        $this->invitationCount = User::whereRelation('invitations', 'receiver', Auth::id())->count();
        $this->amisCount = User::whereRelation('amis', 'user1', Auth::id())->orWhereRelation('amis', 'user2', Auth::id())->count();
        $this->users = User::latest()->whereRelation('invitations', 'receiver', Auth::id())->get();
    }
    public function render()
    {
        return view('livewire.users.invitaions');
    }
}
