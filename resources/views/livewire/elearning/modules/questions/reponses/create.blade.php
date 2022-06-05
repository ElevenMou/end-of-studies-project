<div class="new-cat">
    <div class="form-group">
        <textarea class="form-item" wire:model.debounce.800ms="reponse" placeholder="Repondre à question"></textarea>
        @error('reponse')
            <div class="form-err">
                <p> {{ $message }}</p>
            </div>
        @enderror
    </div>
    <button class="btn primary" wire:click.prevent="create()">
        <i wire:loading wire:target="create" class="fa-solid fa-spinner spin"></i> Repondre
    </button>
</div>
