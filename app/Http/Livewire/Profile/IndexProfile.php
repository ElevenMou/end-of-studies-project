<?php

namespace App\Http\Livewire\Profile;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\Component;

use function PHPUnit\Framework\isEmpty;

class IndexProfile extends Component
{
    use WithFileUploads;

    public $user, $posts;
    public $auth_user;
    public $main = false, $editMode = false, $session = false, $invited = false;
    public $description, $avatar, $path;

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
            $this->path = $this->avatar->store('images/avatars', 'public');;
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


    /************** INVITATION **************/
    public function sendInvit()
    {
        Invitation::create([
            'sender' => $this->auth_user->id,
            'receiver' => $this->user->id
        ]);
        $this->invited = true;
    }
    public function cancelInvit()
    {
        $invite = Invitation::where('sender', $this->auth_user->id)->where('receiver', $this->user->id);
        $invite->delete();
        $this->invited = false;
    }

    public function mount($id)
    {
        $this->auth_user = Auth::user();
        $this->user = User::find($id);
        $this->description = $this->user->description;
        if ($this->user->statu != 1) {
            return redirect('/');
        }
        if ($id == $this->auth_user->id) {
            $this->main = true;
        }
        $invit = Invitation::where('sender', $this->auth_user->id)->where('receiver', $this->user->id)->count();
        if($invit != 0){
            $this->invited = true;
        }
    }
    public function render()
    {
        return view('livewire.profile.index-profile');
    }
}
