<div class="cat-doc">
    @if ($edit)
        <div class="edit-doc">
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
            <div class="edit-actions">
                <button class="edit-action edit" wire:click.prevent="updateDoc()">
                    <i class="fa-regular fa-pen-to-square"></i> Modifier
                </button>
                <button class="edit-action cancel" wire:click.prevent="edit()">
                    Annuler
                </button>
            </div>
        </div>
    @else
        <a href="{{ $document->url }}" class="doc-title">
            {{ $document->titre }}
        </a>
        @if (Auth::user()->type == 2)
            <div class="doc-actions">
                <abbr title="modifier" wire:click.prevent="edit()">
                    <button class="doc-action">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                </abbr>
                <abbr title="supprimer">
                    <button class="doc-action" wire:click.prevent="delete()">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </abbr>
            </div>
        @endif

    @endif
    @if ($confirm)
        <div class="confirm">
            <div class="confirm-card">
                <div class="confirm-msg">
                    Supprimer {{ $document->titre }} ?
                </div>
                <div class="confirm-actions">
                    <button class="btn primary" wire:click.prevent="confirmDelete()">
                        <i wire:loading wire:target="confirmDelete" class="fa-solid fa-spinner spin"></i> Supprimer
                    </button>
                    <button class="btn secondary" wire:click.prevent="delete()">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    @endif

</div>
