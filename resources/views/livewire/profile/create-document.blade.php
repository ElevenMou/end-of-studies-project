<div class="create-doc">
    <div class="doc-group">
        <label for="title">Titre </label>
        <input id="title" type="text" placeholder="Document titre" wire:model="title">
        @error('title')
            <div class="doc-err">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="doc-group">
        <label for="title">Url </label>
        <input id="title" type="text" placeholder="https://drive.google.com/" wire:model="url">
        @error('url')
            <div class="doc-err">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="doc-actions">
        <button class="btn primary" wire:click.prevent="createDoc()">
            <i wire:loading wire:target="createDoc" class="fa-solid fa-spinner spin"></i> Créer
        </button>
        <button class="btn secondary" wire:click.prevent="fermer()">
            Fermer
        </button>
    </div>

</div>
