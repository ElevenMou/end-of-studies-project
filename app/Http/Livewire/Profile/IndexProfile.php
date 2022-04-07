<?php

namespace App\Http\Livewire\Profile;

use App\Models\Follow;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\Component;


use function PHPUnit\Framework\isEmpty;

class IndexProfile extends Component
{
    use WithFileUploads;

    public $user, $posts;
    public $auth_user;
    public $main = false, $editMode = false, $session = false;
    public $following = false, $follower = false; //follower=3amlk follow  following=3amlo follow
    public $description, $avatar, $path;
    public $followingCount, $followersCount;

    protected $rules = [
        'description' => 'nullable|max:300',
        'avatar' => 'image|max:5120|nullable',

    ];

    protected $messages = [
        'description.max' => 'La description ne peut contenir plus de 300 caractères.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function closeSession()
    {
        $this->session = false;
    }

    /************** EDIT PROFILE **************/
    public function editMode()
    {
        $this->editMode = !$this->editMode;
    }

    public function edit()
    {
        $this->validate();
        if ($this->avatar) {
            $extension = $this->avatar->getClientOriginalExtension();
            $name = date('d-m-y').'.'.$extension;
            $this->path =
                $this->avatar->storeAs('images/avatars/' . $this->auth_user->identifiant, $name, 'public');
        }
        if ($this->path) {
            $this->auth_user->update([
                'avatar' => $this->path,
                'description' => $this->description
            ]);
        } else {
            $this->auth_user->update([
                'description' => $this->description
            ]);
        }
        $this->editMode = false;
        $this->session = true;
        session()->flash('success', 'Compte est editer');
    }


    /************** FOLLOW **************/
    public function follow()
    {
        Follow::create([
            'follower' => Auth::id(),
            'following' => $this->user->id
        ]);
        $this->following = true;
        $this->followersCount++;
    }
    public function cancelFollow()
    {
        $follow = Follow::where('follower', Auth::id())->where('following', $this->user->id);
        $follow->delete();
        $this->following = false;
        $this->followersCount--;
    }

    /* --------------------------------------------- */

    public function mount($id)
    {
        $this->auth_user = Auth::user();
        $this->user = User::find($id);
        $this->followersCount = DB::table('follows')->where('following', $id)->count();
        $this->followingCount = DB::table('follows')->where('follower', $id)->count();
        $this->description = $this->user->description;
        if ($this->user->statu != 1) {
            return redirect('/');
        }
        if ($id == $this->auth_user->id) {
            $this->main = true;
        }
        /* USER SUIVRE AUTH USER */
        $flwr = Follow::where('following', Auth::id())->where('follower', $this->user->id)->count();
        if ($flwr != 0) {
            $this->follower = true;
        }
        /* AUTH USER SUIVRE USER*/
        $flwng = Follow::where('following', $this->user->id)->where('follower', Auth::id())->count();
        if ($flwng != 0) {
            $this->following = true;
        }
    }
    public function render()
    {
        return view('livewire.profile.index-profile');
    }
}
