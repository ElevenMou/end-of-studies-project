<div class="container">
    @if ($session)
        @if (session()->has('success'))
            <div class="alert success">
                <button wire:click.prevent="closeSession">X</button>
                <p>{{ session()->get('success') }}</p>
            </div>
        @endif
    @endif
    <div class="module-form">
        <h1>
            Créer Module
        </h1>
        <div class="form-group">
            @if ($thumbnail)
                <div class="thumbnail-preview">
                    <img src="{{ $thumbnail->temporaryUrl() }}">
                </div>
            @else
                <div class="thumbnail-preview">
                    <img src="{{ asset('storage/images/thumbnails/default-thumbnail.jpg') }}">
                </div>
            @endif
            <label for="thumbnail" class="thumbnail">Thumbnail (300x100px)</label>
            <input id="thumbnail" type="file" class="thumbnail-input" wire:model.debounce.800ms="thumbnail" />
            <div wire:loading wire:target="avatar" class="form-label">Téléchargement...</div>

            @error('thumbnail')
                <div class="form-err">
                    <p> {{ $message }}</p>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="titre" class="form-label">Titre</label>
            <input id="titre" type="text" class="form-item" wire:model.debounce.800ms="titre" />
            @error('titre')
                <div class="form-err">
                    <p> {{ $message }}</p>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" wire:model.debounce.800ms="description">
            </textarea>
            @error('description')
                <div class="form-err">
                    <p> {{ $message }}</p>
                </div>
            @enderror
        </div>

        <div class="container">
            <button class="btn primary" wire:click.prevent="saveModule()"><i wire:loading wire:target="saveModule"
                    class="fa-solid fa-spinner spin"></i> Créer</button>
        </div>
    </div>
</div>
