<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class IndexPost extends Component
{
    public $post;

    public function mount($post_id)
    {
        $this->post = Post::find($post_id);
    }
    public function render()
    {
        return view('livewire.posts.index-post');
    }
}
