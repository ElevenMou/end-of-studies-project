<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class IndexPosts extends Component
{
    public $posts;

    public function mount($type)
    {
        if($type == 0){          //friends posts
            $this->posts = DB::table('posts as p')->join('follows as f', 'following', '=', 'user_id')->where('f.follower', Auth::id())
            ->select('p.*')->get();
        } elseif($type == 1){   //enseignats posts
            $this->posts = Post::latest()->whereRelation('user', 'type', 2)->get();
        } elseif($type == 2){   //admin posts
            $this->posts = Post::latest()->whereRelation('user', 'type', 2)->get();
        }
    }
    public function render()
    {
        return view('livewire.posts.index-posts');
    }
}
