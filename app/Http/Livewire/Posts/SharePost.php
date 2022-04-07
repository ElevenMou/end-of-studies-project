<?php

namespace App\Http\Livewire\Posts;

use Livewire\Component;

class SharePost extends Component
{
    public $post_id;
    public $share = false;

    public function share()
    {
        $this->share = !$this->share;
    }
    public function mount($post_id)
    {
        $this->post_id = $post_id;
    }
    public function render()
    {
        return view('livewire.posts.share-post');
    }
}
