<div class="new-cat">
    <div class="form-group">
        <label for="titre" class="form-label">Document titre</label>
        <input id="titre" class="form-item" wire:model.debounce.800ms="titre" \>
        @error('titre')
            <div class="form-err">
                <p> {{ $message }}</p>
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="url" class="form-label">Document URL</label>
        <input id="url" class="form-item" wire:model.debounce.800ms="url" \>
        @error('url')
            <div class="form-err">
                <p> {{ $message }}</p>
            </div>
        @enderror
    </div>
    <button class="create-btn" wire:click.prevent="createDoc()">
        <i wire:loading wire:target="createDoc" class="fa-solid fa-spinner spin"></i> Créer
    </button>
</div>
