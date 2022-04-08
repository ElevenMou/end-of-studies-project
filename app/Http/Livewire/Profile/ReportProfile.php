<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use App\Models\ProfileReport;
use Illuminate\Support\Facades\Auth;

class ReportProfile extends Component
{
    public $confirm = false, $done = false;
    public $user_id;

    public function report()
    {
        $this->confirm = !$this->confirm;
    }

    public function confirmReport()
    {
        ProfileReport::create([
            'reporter' => Auth::id(),
            'reported' => $this->user_id
        ]);
        $this->done = true;
    }

    public function mount($user_id)
    {
        $reported = ProfileReport::where('reporter', Auth::id())->where('reported', $user_id)->count();
        if ($reported != 0) {
            $this->done = true;
        }
        $this->user_id = $user_id;
    }
    public function render()
    {
        return view('livewire.profile.report-profile');
    }
}
