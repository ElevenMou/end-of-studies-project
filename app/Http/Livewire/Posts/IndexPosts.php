<?php

namespace App\Http\Livewire\Posts;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IndexPosts extends Component
{
    public $posts, $postsType;
    public $postsPerPage = 2;

    public function loadMore()
    {
        $this->postsPerPage = $this->postsPerPage + 2;

        if ($this->postsType == 0) {          //follows posts
            $this->posts = $this->posts = DB::table('posts as p')
                ->join('follows as f', 'following', '=', 'user_id')
                ->join('users as u', 'u.id', '=', 'user_id')
                ->leftJoin('post_like as l', 'l.post_id', '=', 'p.id')
                ->where('f.follower', Auth::id())
                ->selectRaw('p.*, u.nom, u.prenom, u.type, u.avatar, count(p.id) as likes')
                ->groupBy('p.id')
                ->orderByDesc('likes')
                ->take($this->postsPerPage)->get();

        } elseif ($this->postsType == 1) {   //enseignats posts
            $this->posts = $this->posts = DB::table('posts as p')
                ->join('users as u', 'u.id', '=', 'user_id')
                ->where('u.type', 1)
                ->selectRaw('p.*, u.nom, u.prenom, u.type, u.avatar')
                ->take($this->postsPerPage)->get();

        } elseif ($this->postsType == 2) {   //admin posts
            $this->posts = $this->posts = DB::table('posts as p')
                ->join('users as u', 'u.id', '=', 'user_id')
                ->where('u.type', 2)
                ->orderByDesc('p.created_at')
                ->selectRaw('p.*, u.nom, u.prenom, u.type, u.avatar')
                ->take($this->postsPerPage)->get();
        }
    }

    public function mount($type)
    {
        $this->postsType = $type;
        if ($type == 0) {          //follows posts
            $this->posts = $this->posts = DB::table('posts as p')
                ->join('follows as f', 'following', '=', 'user_id')
                ->join('users as u', 'u.id', '=', 'user_id')
                ->leftJoin('post_like as l', 'l.post_id', '=', 'p.id')
                ->where('f.follower', Auth::id())
                ->selectRaw('p.*, u.nom, u.prenom, u.type, u.avatar, count(p.id) as likes')
                ->groupBy('p.id')->orderByDesc('likes')
                ->take($this->postsPerPage)->get();
        } elseif ($type == 1) {   //enseignats posts
            $this->posts = $this->posts = DB::table('posts as p')
                ->join('users as u', 'u.id', '=', 'user_id')
                ->where('u.type', 1)
                ->selectRaw('p.*, u.nom, u.prenom, u.type, u.avatar')
                ->take($this->postsPerPage)->get();
        } elseif ($type == 2) {   //admin posts
            $this->posts = $this->posts = DB::table('posts as p')
                ->join('users as u', 'u.id', '=', 'user_id')
                ->where('u.type', 2)
                ->orderByDesc('p.created_at')
                ->selectRaw('p.*, u.nom, u.prenom, u.type, u.avatar')
                ->take($this->postsPerPage)->get();
        }
    }
    public function render()
    {
        return view('livewire.posts.index-posts');
    }
}
