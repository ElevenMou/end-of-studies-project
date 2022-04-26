<?php

namespace App\Http\Livewire\Posts;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IndexPosts extends Component
{
    public $posts, $postsType;
    public $postsPerPage = 15, $postsCount;

    public function loadMore()
    {
        $this->postsPerPage = $this->postsPerPage + 10;

        if ($this->postsType == 0) {          //follows posts
            $this->posts = $this->posts = DB::table('posts as p')
                ->join('follows as f', 'following', '=', 'user_id')
                ->join('users as u', 'u.id', '=', 'user_id')
                ->where('f.follower', Auth::id())
                ->where('u.statu', 1)->orderByDesc('p.created_at')
                ->select('p.id')
                ->take($this->postsPerPage)->get();
            /* COUNT POSTS */
            $this->postsCount = DB::table('posts as p')
                ->join('follows as f', 'following', '=', 'user_id')
                ->where('f.follower', Auth::id())->count();

            /*------- enseignats posts ---------------*/
        } elseif ($this->postsType == 1) {
            $this->posts = $this->posts = DB::table('posts as p')
                ->join('users as u', 'u.id', '=', 'user_id')
                ->join('follows as f', 'following', '=', 'user_id')
                ->where('f.follower', Auth::id())->where('u.type', 1)
                ->orderByDesc('p.created_at')->select('p.id')
                ->take($this->postsPerPage)->get();
            /* COUNT POSTS */
            $this->postsCount = DB::table('posts as p')
                ->join('users as u', 'u.id', '=', 'user_id')
                ->join('follows as f', 'following', '=', 'user_id')
                ->where('f.follower', Auth::id())->where('u.type', 1)
                ->selectRaw('p.*, u.nom, u.prenom, u.type, u.avatar')->count();
        } elseif ($this->postsType == 2) {   //admin posts
            $this->posts = $this->posts = DB::table('posts as p')
                ->join('users as u', 'u.id', '=', 'user_id')
                ->where('u.type', 2)
                ->orderByDesc('p.created_at')
                ->select('p.id')
                ->take($this->postsPerPage)->get();
            /* COUNT POSTS */
            $this->postsCount = DB::table('posts as p')
                ->join('users as u', 'u.id', '=', 'user_id')
                ->where('u.type', 2)
                ->orderByDesc('p.created_at')
                ->select('p.id')->count();
        }
    }

    public function mount($type)
    {
        $this->postsType = $type;
        if ($type == 0) {          //follows posts
            $this->posts = DB::table('posts as p')
                ->join('follows as f', 'following', '=', 'user_id')
                ->join('users as u', 'u.id', '=', 'user_id')
                ->where('f.follower', Auth::id())
                ->where('u.statu', 1)->orderByDesc('p.created_at')
                ->select('p.id')
                ->take($this->postsPerPage)->get();
            /* COUNT POSTS */
            $this->postsCount = DB::table('posts as p')
                ->join('follows as f', 'following', '=', 'user_id')
                ->where('f.follower', Auth::id())->count();
        } elseif ($type == 1) {   //enseignats posts
            $this->posts = DB::table('posts as p')
                ->join('users as u', 'u.id', '=', 'user_id')
                ->join('follows as f', 'following', '=', 'user_id')
                ->where('f.follower', Auth::id())->where('u.type', 1)
                ->orderByDesc('p.created_at')->select('p.id')
                ->take($this->postsPerPage)->get();
            /* COUNT POSTS */
            $this->postsCount = DB::table('posts as p')
                ->join('users as u', 'u.id', '=', 'user_id')
                ->join('follows as f', 'following', '=', 'user_id')
                ->where('f.follower', Auth::id())->where('u.type', 1)
                ->selectRaw('p.*, u.nom, u.prenom, u.type, u.avatar')->count();
        } elseif ($type == 2) {   //admin posts
            $this->posts = DB::table('posts as p')
                ->join('users as u', 'u.id', '=', 'user_id')
                ->where('u.type', 2)
                ->orderByDesc('p.created_at')
                ->select('p.id')
                ->take($this->postsPerPage)->get();
            /* COUNT POSTS */
            $this->postsCount = DB::table('posts as p')
                ->join('users as u', 'u.id', '=', 'user_id')
                ->where('u.type', 2)
                ->select('p.id')->count();
        }
    }
    public function render()
    {
        return view('livewire.posts.index-posts');
    }
}
