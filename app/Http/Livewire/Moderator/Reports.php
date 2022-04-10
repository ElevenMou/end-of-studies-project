<?php

namespace App\Http\Livewire\Moderator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Reports extends Component
{
    public $pageStatu = 0;
    public $posts, $users;

    protected $listeners = ['userSuspendre'];

    public function userSuspendre()
    {
        $this->users = DB::table('users as u')
            ->join('profile_reports as r', 'u.id', '=', 'r.reported')
            ->where('u.statu', 1)
            ->selectRaw('u.id as id ,count(u.id) as reports')
            ->groupBy('u.id')->having('reports','>',5)
            ->orderByDesc('reports')->get();
    }

    public function users()
    {
        $this->pageStatu = 1;
        $this->users = DB::table('users as u')
            ->join('profile_reports as r', 'u.id', '=', 'r.reported')
            ->where('u.statu', 1)
            ->selectRaw('u.id as id ,count(u.id) as reports')
            ->groupBy('u.id')->having('reports','>',5)
            ->orderByDesc('reports')->get();
    }

    public function posts()
    {
        $this->pageStatu = 0;
        $this->posts = DB::table('posts as p')
            ->join('post_reports as r', 'p.id', '=', 'r.post_id')
            ->selectRaw('p.id as id ,count(p.id) as reports')
            ->groupBy('p.id')->having('reports', '>', 5)
            ->orderByDesc('reports')->get();
    }

    public function mount()
    {
        if (Auth::user()->isModerator) {
            $this->posts = DB::table('posts as p')
                ->join('post_reports as r', 'p.id', '=', 'r.post_id')
                ->selectRaw('p.id as id ,count(p.id) as reports')
                ->groupBy('p.id')->having('reports', '>', 5)
                ->orderByDesc('reports')->get();
        } else {
            return redirect(route('home'));
        }
    }
    public function render()
    {
        return view('livewire.moderator.reports');
    }
}
