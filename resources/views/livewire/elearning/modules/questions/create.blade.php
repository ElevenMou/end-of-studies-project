<div class="new-cat">
    <div class="form-group">
        <textarea class="form-item" wire:model.debounce.800ms="question" placeholder="Poser une question"></textarea>
        @error('question')
            <div class="form-err">
                <p> {{ $message }}</p>
            </div>
        @enderror
    </div>
    <button class="btn primary" wire:click.prevent="create()">
        <i wire:loading wire:target="create" class="fa-solid fa-spinner spin"></i> Poser ma
        question
    </button>
    @if ($session)
        @if (session()->has('success'))
            <div class="alert success">
                <button wire:click.prevent="closeSession">X</button>
                <p>{{ session()->get('success') }}</a>
                </p>
            </div>
        @endif
    @endif
</div>
