<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class AdminPosts extends Component
{
    public $posts;

    public function mount()
    {
        $this->posts = Post::latest()->whereRelation('user', 'type', 2)->get();
    }

    public function render()
    {
        return view('livewire.posts.admin-posts');
    }
}
