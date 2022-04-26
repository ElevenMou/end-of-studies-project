<div class="question-actions">
    <button class="question-action" wire:click.prevent="down()">
        @if ($down)
            <i class="fa-solid fa-circle-down selected"></i>
        @else
            <i class="fa-regular fa-circle-down"></i>
        @endif
    </button>
    <span class="post-counter">
        @if ($count < 0)
            0
        @else
            {{ $count }}
        @endif
    </span>
    <button class="question-action" wire:click.prevent="up()">
        @if ($up)
            <i class="fa-solid fa-circle-up selected"></i>
        @else
            <i class="fa-regular fa-circle-up"></i>
        @endif
    </button>
</div>
