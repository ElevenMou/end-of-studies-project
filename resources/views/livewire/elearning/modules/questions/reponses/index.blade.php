<div class="question-reponses">
    @if ($question->module->enseignant == Auth::id())
        @livewire('elearning.modules.questions.reponses.create', ['question_id' => $question->id])
    @endif

    @if ($reponses->count() != 0)
        <h3>Reponses</h3>
    @endif

    @foreach ($reponses as $reponse)
        <div class="response">
            <div class="reponse-header">
                {{ $reponse->question->module->user->nom }} {{ $reponse->question->module->user->prenom }}
                @if ($reponse->question->module->enseignant == Auth::id())
                    <abbr title="supprimer">
                        <button class="reponse-action" wire:click.prevent="delete({{ $reponse->id }})">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </abbr>
                @endif
            </div>
            <div class="reponse-content">
                {{ $reponse->reponse }}
            </div>
        </div>
    @endforeach
</div>
