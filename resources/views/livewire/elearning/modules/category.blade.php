<div class="module-category">
    <h2 class="category-title">
        @if ($edit)
            <input class="edit-title" type="text" wire:model.debounce.500ms="titre">
            <abbr title="modifier">
                <button class="title-edit" wire:click.prevent="save()">
                    <i class="fa-regular fa-pen-to-square"></i>
                </button>
            </abbr>
            <abbr title="annuler">
                <button class="title-edit" wire:click.prevent="edit()">
                    <i class="fa-solid fa-ban"></i>
                </button>
            </abbr>
        @else
            {{ $category->titre }}
            @if ($category->module->enseignant == Auth::id())
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
            @endif
        @endif
    </h2>
    @if ($confirm)
        <div class="confirm">
            <div class="confirm-card">
                <div class="confirm-msg">
                    Supprimer {{$category->titre}} ?
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
    <div class="category-documents">
        @forelse ($category->documents as $document)
            @livewire('elearning.modules.index-document', ['document' => $document], key($document->id))
        @empty
            <div class="empty-result">
                rien à afficher ici!
            </div>
        @endforelse
        @if ($create)
            <button class="action refuser" wire:click.prevent="create()">
                Annuler
            </button>
            @livewire('elearning.modules.create-document', ['category_id' => $category->id])
        @else
            @if ($category->module->enseignant == Auth::id())
                <button class="create-cat" wire:click.prevent="create()">
                    <i class="fa-solid fa-plus"></i> Ajouter document
                </button>
            @endif
        @endif
    </div>
</div>
