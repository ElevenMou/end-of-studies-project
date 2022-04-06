<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comment extends Component
{
    public $comments, $commentsCount;
    public $commentsPerPage = 2, $commentsLeft;
    public $post;

    protected $listeners = ['newComment'];


    public function loadMore()
    {
        $this->commentsPerPage += 5;
        $this->comments = PostComment::latest()->whereRelation('user', 'statu', 1)
            ->where('post_id', $this->post->id)->take($this->commentsPerPage)->get();
        $this->commentsLeft = $this->commentsCount - $this->commentsPerPage;
    }

    public function newComment()
    {
        $this->comments = PostComment::latest()->whereRelation('user', 'statu', 1)
            ->where('post_id', $this->post->id)->take($this->commentsPerPage)->get();
        $this->commentsCount++;
        $this->commentsLeft = $this->commentsCount - $this->commentsPerPage;
    }

    public function deleteComment($id)
    {
        $cmnt = PostComment::find($id);
        $cmnt->delete();
        $this->comments = PostComment::latest()->whereRelation('user', 'statu', 1)
            ->where('post_id', $this->post->id)->take($this->commentsPerPage)->get();
        $this->session = true;
        $this->commentsCount--;
        $this->commentsLeft--;
    }


    public function mount($post_id)
    {
        $this->post = Post::find($post_id);
        $this->comments = PostComment::latest()->whereRelation('user', 'statu', 1)
            ->where('post_id', $post_id)->take($this->commentsPerPage)->get();
        $this->commentsCount = $this->post->comments->count();
        $this->commentsLeft = $this->commentsCount - 2;
    }
    public function render()
    {
        return view('livewire.posts.comment');
    }
}
