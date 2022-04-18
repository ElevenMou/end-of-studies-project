<div class="container">
    <div class="e-header">
        @if ($create)
            <button class="btn-create" wire:click.prevent="create()">
                Annuler
            </button>
        @else
            <button class="btn-create" wire:click.prevent="create()">
                Créer module
            </button>
        @endif
    </div>
    @if ($create)
        @livewire('elearning.modules.create')
    @endif
    <div class="modules">

        @forelse ($modules as $module)
            <div class="module">
                <div class="thumbnail">
                    <img src="{{ asset('storage/' . $module->thumbnail) }}" alt="thumbnail">
                </div>
                <div class="module-info">
                    <div class="titre">
                        {{ $module->titre }}
                    </div>
                    <a href="{{ route('profile', $module->enseignant) }}" class="enseignant">
                        {{ $module->user->nom }} {{ $module->user->prenom }}
                    </a>
                    <pre class="description">{{ $module->description }}</pre>
                </div>
                <div class="module-actions">
                    <button class="acion edit">
                        modifier
                    </button>
                </div>
            </div>
        @empty
            <div class="empty-result">
                Aucun Module
            </div>
        @endforelse

    </div>
</div>
