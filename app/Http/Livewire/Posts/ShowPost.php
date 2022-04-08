<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowPost extends Component
{
    public $post;

    public function mount($id)
    {
        $this->post = Post::find($id);
        if ($this->post) {
            if ($this->post->user->type != 2) {
                if (!Auth::check()) {
                    return redirect(route('authentification'));
                }
            }
        } else{
            return redirect(route('home'));
        }
    }

    public function render()
    {
        return view('livewire.posts.show-post');
    }
}
