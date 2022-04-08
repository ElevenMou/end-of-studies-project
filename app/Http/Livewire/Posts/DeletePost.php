<?php

namespace App\Http\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;

class DeletePost extends Component
{
    public $confirm = false;
    public $post;

    public function delete()
    {
        $this->confirm = !$this->confirm;
    }

    public function confirmDelete()
    {
        if ($this->post) {
            $this->post->delete();
            $this->confirm = false;
        } else {
            $this->confirm = false;
        }
    }

    public function mount($post_id)
    {
        $this->post = Post::find($post_id);
    }
    public function render()
    {
        return view('livewire.posts.delete-post');
    }
}
