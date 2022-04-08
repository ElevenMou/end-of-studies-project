<?php

namespace App\Http\Livewire\Posts;

use App\Models\CommentLike;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikeComment extends Component
{
    public $cmnt_id;
    public $likesCount;
    public $liked = false;

    public function like()
    {
        if($this->liked){
            $like = CommentLike::where('comment_id', $this->cmnt_id)->where('user_id', Auth::id());
            $like->delete();
            $this->liked = false;
            $this->likesCount--;
        } else{
            CommentLike::create([
                'comment_id' => $this->cmnt_id,
                'user_id' => Auth::id()
            ]);
            $this->liked = true;
            $this->likesCount++;
        }
    }

    public function mount($cmnt_id)
    {
        $this->cmnt_id = $cmnt_id;
        $this->likesCount = CommentLike::where('comment_id', $cmnt_id)->count();
        $lkd = CommentLike::where('comment_id', $cmnt_id)->where('user_id', Auth::id())->count();
        if($lkd != 0){
            $this->liked = true;
        }
    }
    public function render()
    {
        return view('livewire.posts.like-comment');
    }
}
