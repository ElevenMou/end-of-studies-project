<div class="new-cat-form">
    <div class="form-group">
        <label for="titre" class="form-label">Catégorie titre</label>
        <input id="titre" placeholder="Titre de categorie" class="form-item" wire:model.debounce.800ms="titre" \>
        @error('titre')
            <div class="form-err">
                <p> {{ $message }}</p>
            </div>
        @enderror
    </div>
    <button class="create-btn" wire:click.prevent="createCat()">
        <i wire:loading wire:target="createCat" class="fa-solid fa-spinner spin"></i> Créer
    </button>

    @if (session()->has('success'))
        <div class="alert success">
            <button wire:click.prevent="closeSession()">X</button>
            <p>{{ session()->get('success') }}</p>
        </div>
    @endif
</div>
