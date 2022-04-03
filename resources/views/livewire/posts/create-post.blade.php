<div class="newpost">

    <div class="content">

        <textarea placeholder="Ecrire votre idées" wire:model.debounce.800ms="contenu"></textarea>
        @error('contenu')
            <div class="form-err">
                <p> {{ $message }}</p>
            </div>
        @enderror
        <label for="postImage"><i class="far fa-image"></i>Ajouter une image</label>
        <input id="postImage" type="file" wire:model.debounce.800ms="image" \>
        @error('image')
            <div class="form-err">
                <p> {{ $message }}</p>
            </div>
        @enderror
        @if ($image)
            <div class="image-preview">
                <img src="{{ $image->temporaryUrl() }}" \>
            </div>
        @endif
    </div>

    <button class="btn primary" wire:click.prevent="savePost()" wire:loading.attr="disabled" wire:target="savePost">
        <i class="fa-solid fa-spinner spin" wire:loading wire:target="savePost"></i> Publier
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
