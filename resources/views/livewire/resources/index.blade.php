<div class="resources">

    <h1>
        Resources
    </h1>
    @forelse ($categories as $cat)
        @livewire('resources.index-category', ['cat' => $cat], key($cat->id))
    @empty
        <div class="empty-result">
            rien à afficher ici!
        </div>
    @endforelse
    @if (Auth::user()->type == 2)
        <div class="new-cat">
            <button class="action edit" wire:click.prevent="newCatForm()">
                @if ($newCat)
                    Fermer
                @else
                    Creer categorie
                @endif

            </button>
            @if ($newCat)
                @livewire('resources.create-category')
            @endif
        </div>
    @endif

</div>
