<?php

namespace App\Http\Livewire\Posts;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class IndexUserPosts extends Component
{
    public $posts;

    public function mount($user_id)
    {
        $this->posts = $this->posts = DB::table('posts as p')
        ->join('users as u', 'u.id', '=', 'user_id')
        ->where('u.id', $user_id)
        ->orderByDesc('p.created_at')
        ->selectRaw('p.*, u.nom, u.prenom, u.type, u.avatar')
        ->get();
    }
    public function render()
    {
        return view('livewire.posts.index-user-posts');
    }
}
