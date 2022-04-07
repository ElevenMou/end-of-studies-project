<?php

namespace App\Http\Livewire\Posts;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class IndexUserPosts extends Component
{
    public $posts, $user;
    public $postsPerPage = 15, $postsCount;
    public function loadMore()
    {
        $this->postsPerPage = $this->postsPerPage + 10;
        $this->posts = $this->posts = DB::table('posts')
            ->where('user_id', $this->user->id)
            ->orderByDesc('created_at')
            ->select('id')->take($this->postsPerPage)->get();
    }

    public function mount($user_id)
    {
        $this->user = User::find($user_id);
        $this->posts = $this->posts = DB::table('posts')
            ->where('user_id', $user_id)
            ->orderByDesc('created_at')
            ->select('id')->take($this->postsPerPage)->get();

        $this->postsCount = DB::table('posts as p')
            ->join('users as u', 'u.id', '=', 'user_id')
            ->where('u.id', $user_id)->count();
    }
    public function render()
    {
        return view('livewire.posts.index-user-posts');
    }
}
