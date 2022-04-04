<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class IndexUserPosts extends Component
{
    public $posts;

    public function mount($user_id)
    {
        $this->posts = Post::where('user_id', $user_id)->get();
    }
    public function render()
    {
        return view('livewire.posts.index-user-posts');
    }
}
