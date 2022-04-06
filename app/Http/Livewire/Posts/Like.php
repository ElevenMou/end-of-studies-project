<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Like extends Component
{
    public $isLiked = false;
    public $likesCount;
    public $post;

    public function like()
    {
        if (!Auth::check()) {
            return redirect(route('authentification'));
        }
        if ($this->isLiked) {
            $like = PostLike::where('post_id', $this->post->id)->where('user_id', Auth::id());
            $like->delete();
            $this->isLiked = false;
            $this->likesCount--;
        } else {
            Postlike::create([
                'post_id' => $this->post->id,
                'user_id' => Auth::id()
            ]);
            $this->isLiked = true;
            $this->likesCount++;
        }
    }

    public function mount($post_id)
    {
        $this->post = Post::find($post_id);
        $this->likesCount = $this->post->likes->count();
        $lkd = PostLike::where('user_id', Auth::id())->where('post_id', $this->post->id)->count();
        if ($lkd != 0) {
            $this->isLiked = true;
        }
    }
    public function render()
    {
        return view('livewire.posts.like');
    }
}
