<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class IndexPosts extends Component
{
    public $posts;

    public function render()
    {
        return view('livewire.posts.index-posts');
    }
}
