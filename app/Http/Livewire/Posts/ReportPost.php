<?php

namespace App\Http\Livewire\Posts;

use App\Models\PostReport;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReportPost extends Component
{
    public $confirm = false, $done = false;
    public $post_id;

    public function report()
    {
        $this->confirm = !$this->confirm;
    }

    public function confirmReport()
    {
        PostReport::create([
            'user_id' => Auth::id(),
            'post_id' => $this->post_id
        ]);
        $this->done = true;
    }

    public function mount($post_id)
    {
        $reported = PostReport::where('user_id', Auth::id())->where('post_id', $post_id)->count();
        if ($reported != 0) {
            $this->done = true;
        }
        $this->post_id = $post_id;
    }
    public function render()
    {
        return view('livewire.posts.report-post');
    }
}
