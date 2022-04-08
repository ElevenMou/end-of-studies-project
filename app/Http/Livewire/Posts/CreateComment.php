<?php

namespace App\Http\Livewire\Posts;

use App\Models\PostComment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateComment extends Component
{
    public $comment;
    public $post;
    public $session = false;

    protected $rules = [
        'comment' => 'required|max:900|min:2',
    ];

    protected $messages = [
        'contenu.min' => 'La commentaire contenu doit contenir au moins 2 caractères.',
        'contenu.max' => 'La commentaire contenu ne peut contenir plus de 900 caractères.',
    ];

    public function saveComment()
    {
        if (!Auth::check()) {
            return redirect(route('authentification'));
        } elseif (Auth::user()->statu != 1) {
            $this->session = true;
            return session()->flash('danger', "Votre compte n'est pas active");
        }
        $this->validate();
        PostComment::create([
            'user_id' => Auth::id(),
            'post_id' => $this->post->id,
            'contenu' => $this->comment
        ]);
        $this->comment = '';
        $this->session = true;
        session()->flash('success', 'commentaire est créer');
        $this->emit('newComment',$this->post->id);
    }

    public function closeSession()
    {
        $this->session = false;
    }

    public function mount($post_id)
    {
        $this->post = Post::find($post_id);
    }

    public function render()
    {
        return view('livewire.posts.create-comment');
    }
}
