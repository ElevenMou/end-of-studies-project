<div class="question-actions">

    <span class="reactions-counter">
        {{ $count }}
    </span>

    <button class="question-action" wire:click.prevent="up()">
        @if ($up)
            <i class="fa-solid fa-circle-up selected"></i>
        @else
            <i class="fa-regular fa-circle-up"></i>
        @endif
    </button>
</div>
