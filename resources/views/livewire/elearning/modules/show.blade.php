<div class="container">
    <div class="module-header">
        <div class="header-top">
            <h1>{{ $module->titre }}</h1>
            @if (Auth::id() == $module->enseignant)
                <a href="{{ route('notes.remplir', $module->id) }}" class="fill-notes">remplir notes</a>
            @endif

        </div>

        <a href="{{ route('profile', $module->enseignant) }}" class="enseignant">
            <div class="enseignant-avatar">
                <img src="{{ asset('storage/' . $module->user->avatar) }}" alt="avatar">
            </div>
            <div class="enseignant-name">
                {{ ucfirst($module->user->nom) }} {{ ucfirst($module->user->prenom) }}
            </div>
        </a>
        <pre class="description">{{ $module->description }}</pre>
    </div>

    <div class="module-main">
        {{-- Etudient Inscrit Et Enseignant --}}

        @if (($module->lock && $inscrir) || $module->enseignant == Auth::id() || !$module->lock)
            <div class="main-card">
                @forelse ($module->categories as $category)
                    @livewire('elearning.modules.category', ['category' => $category], key($category->id))
                @empty
                    <div class="empty-result">
                        rien à afficher ici!
                    </div>
                @endforelse
                @if ($create)
                    <button class="action refuser" wire:click.prevent="create()">
                        Annuler
                    </button>
                    @livewire('elearning.modules.create-category', ['module_id' => $module->id])
                @else
                    @if ($module->enseignant == Auth::id())
                        <button class="create-cat" wire:click.prevent="create()">
                            <i class="fa-solid fa-plus"></i> Créer catégorie
                        </button>
                    @endif
                @endif
            </div>

            <div class="main-card">
                <h2>Questions ({{ $count }})</h2>
                @if (Auth::id() != $module->enseignant)
                    @livewire('elearning.modules.questions.create', ['module_id' => $module->id])
                @endif
                @livewire('elearning.modules.questions.index-all', ['module_id' => $module->id])
            </div>
        @else
            {{-- Etudient non inscrit --}}
            <div class="main-card">
                <h2> Module est Verrouillé</h2>
                @livewire('elearning.modules.inscrir-module', ['module' => $module])
            </div>

        @endif

    </div>


</div>
