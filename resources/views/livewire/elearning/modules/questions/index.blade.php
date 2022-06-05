<div class="question">
    <div class="question-header">
        <a href="{{ route('profile', $question->user->id) }}" class="person">
            <div class="img-container">
                <img src="
                    {{ asset('storage/' . $question->user->avatar) }}
                    " alt="Profile picture">
            </div>
            <div class="name">
                {{ ucfirst($question->user->prenom) }} {{ ucfirst($question->user->nom) }}
            </div>
        </a>
        <div class="created-at">
            {{ $question->created_at->diffForHumans() }}
        </div>
    </div>

    <div class="question-main">
        <pre class="question-content"> {{ $question->question }} </pre>

        <div class="q-actions">
            @if ($question->module->enseignant == Auth::id() || $question->user_id == Auth::id())
                @livewire('elearning.modules.questions.delete', ['question_id' => $question->id], key($question->id))
            @else
            <div class="fixer"></div>
            @endif

            @livewire('elearning.modules.questions.like', ['question_id' => $question->id], key($question->id))
        </div>

    </div>

    @livewire('elearning.modules.questions.reponses.index', ['question_id' => $question->id], key($question->id))


</div>
