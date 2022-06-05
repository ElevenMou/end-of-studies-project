<div class="container">
    @forelse ($questions as $question)
        @livewire('elearning.modules.questions.index', ['question_id' => $question->id], key($question->id))
    @empty
        <div class="empty-result">
            Aucun question
        </div>
    @endforelse
    @if ($count > $questionsPerPage)
        <button class="btn secondary" wire:click.prevent="loadMore()">
            voir plus <i wire:loading wire:target="loadMore" class="fa-solid fa-spinner spin"></i>
        </button>
    @elseif($count != 0)
        <div class="empty-result">
            il ne reste plus de questions
        </div>
    @endif
</div>
