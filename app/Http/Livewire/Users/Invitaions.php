<?php

namespace App\Http\Livewire\Users;

use App\Models\Ami;
use App\Models\Invitation;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class Invitaions extends Component
{
    public $search;
    public $pageStatu = 0; //0=invitation 1=amis 2=search
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

    public function accepter($id)
    {
        $invite = Invitation::where('sender', $id)->where('receiver', Auth::id());
        $invite->delete();
        Ami::create([
            'user1' => $id,
            'user2' => Auth::id()
        ]);
        $this->users = User::latest()->whereRelation('invitations', 'receiver', Auth::id())->get();
        $this->invitationCount--;
        $this->amisCount++;
        $this->emit('minusInvite');
    }

    public function searchUser()
    {
        $this->validate();
        $this->pageStatu = 2;
        $this->users = User::where('identifiant', $this->search)->where('type', 0)->get();
    }

    public function invitation()
    {
        $this->users = User::latest()->whereRelation('invitations', 'receiver', Auth::id())->get();
        $this->pageStatu = 0;
        $this->search = '';
    }

    public function amis()
    {
        $this->users = User::whereRelation('amis', 'user1', Auth::id())->orWhereRelation('amis', 'user2', Auth::id())->get();
        $this->pageStatu = 1;
        $this->search = '';
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
