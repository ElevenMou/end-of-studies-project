<?php

namespace App\Http\Livewire\Elearning\Modules\Questions;

use App\Models\elearning\ModuleQuestion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public $question;
    public $module_id;
    public $session = false;

    protected $rules = [
        'question' => 'required|string|max:600|min:15',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create()
    {
        $this->validate();
        ModuleQuestion::create([
            'question' => $this->question,
            'module_id' => $this->module_id,
            'user_id' => Auth::id()
        ]);
        $this->session = true;
        session()->flash('success', 'Question est créer');
        $this->emit('refreshQuestions');
        $this->question = '';
    }

    public function closeSession()
    {
        $this->session = false;
    }

    public function mount($module_id)
    {
        $this->module_id = $module_id;
    }

    public function render()
    {
        return view('livewire.elearning.modules.questions.create');
    }
}
