<div class="resources-cat">
    <h2 class="cat-header">
        @if ($edit)
            <div class="edit-cat-form">

                <input id="titre" class="form-item" wire:model.debounce.800ms="titre"\>
                @error('titre')
                    <div class="form-err">
                        <p> {{ $message }}</p>
                    </div>
                @enderror

                <button class="save-btn" wire:click.prevent="updateCat()">
                    <i wire:loading wire:target="createCat" class="fa-solid fa-spinner spin"></i> Sauvgarder
                </button>

                <button class="cancel-btn" wire:click.prevent="edit()">
                    <i wire:loading wire:target="createCat" class="fa-solid fa-spinner spin"></i> Annuler
                </button>

                @if (session()->has('success'))
                    <div class="alert success">
                        <button wire:click.prevent="closeSession()">X</button>
                        <p>{{ session()->get('success') }}</p>
                    </div>
                @endif
            </div>
        @else
            <div class="cat-title">
                {{ $cat->titre }}
            </div>
            @if (Auth::user()->type == 2)
                <abbr title="modifier">
                    <button class="category-acion" wire:click.prevent="edit()">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                </abbr>
                <abbr title="supprimer">
                    <button class="category-acion" wire:click.prevent="delete()">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </abbr>
                @if ($confirm)
                    <div class="confirm">
                        <div class="confirm-card">
                            <div class="confirm-msg">
                                Supprimer {{ $cat->titre }} ?
                            </div>
                            <div class="confirm-actions">
                                <button class="btn primary" wire:click.prevent="confirmDelete()">
                                    <i wire:loading wire:target="confirmDelete" class="fa-solid fa-spinner spin"></i>
                                    Supprimer
                                </button>
                                <button class="btn secondary" wire:click.prevent="delete()">
                                    Annuler
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

        @endif


    </h2>
    <div class="cat-docs">
        @forelse ($cat->documents as $doc)
            @livewire('resources.index-document', ['doc' => $doc], key($doc->id))
        @empty
            <div class="empty-result">
                rien à afficher ici!
            </div>
        @endforelse
        @if (Auth::user()->type == 2)
            <button class="action secondary" wire:click.prevent="newDocForm()">
                @if ($newDoc)
                    Fermer
                @else
                    Creer document
                @endif

            </button>
            @if ($newDoc)
                @livewire('resources.create-document', ['category_id' => $cat->id])
            @endif
        @endif

    </div>
</div>
