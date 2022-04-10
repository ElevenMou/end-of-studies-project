<?php

namespace App\Http\Livewire\Profile;

use App\Models\Follow;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FollowUser extends Component
{
    public $following = false;

    /************** FOLLOW **************/
    public function follow()
    {
        Follow::create([
            'follower' => Auth::id(),
            'following' => $this->user->id
        ]);
        $this->following = true;
        $this->emit('follow');
    }
    public function cancelFollow()
    {
        $follow = Follow::where('follower', Auth::id())->where('following', $this->user->id);
        $follow->delete();
        $this->following = false;
        $this->emit('cancelFollow');
    }

    public function mount($user)
    {
        $this->user = $user;
        /* AUTH USER SUIVRE USER*/
        $flwng = Follow::where('following', $this->user->id)->where('follower', Auth::id())->count();
        if ($flwng != 0) {
            $this->following = true;
        }
    }

    public function render()
    {
        return view('livewire.profile.follow-user');
    }
}
