<?php

namespace App\Http\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;

class DeletePost extends Component
{
    public $confirm = false, $done = false;
    public $post;

    public function delete()
    {
        $this->confirm = !$this->confirm;
    }

    public function confirmDelete()
    {
            $this->post->delete();
            $this->done = true;
    }

    public function mount($post_id)
    {
        $this->post = Post::find($post_id);
        if ($this->post) {
            $this->done = false;
        } else{
            $this->done = true;
        }
    }
    public function render()
    {
        return view('livewire.posts.delete-post');
    }
}
