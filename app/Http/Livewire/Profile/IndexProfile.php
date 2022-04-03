<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class IndexProfile extends Component
{

    public $user;
    public $auth_user;
    public $main = false, $editMode = false, $session = false;
    public $description, $avatar;

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

    public function editMode()
    {
        $this->editMode = !$this->editMode;
    }

    public function mount($id)
    {
        $this->auth_user = Auth::user();
        $this->user = User::find($id);
        if($id == $this->auth_user->id){
            $this->main = true;
        }
    }
    public function render()
    {
        return view('livewire.profile.index-profile');
    }
}
