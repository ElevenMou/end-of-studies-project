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

    <div class="modules-card">
        <h2>Votre Modules</h2>
        <div class="modules">
            @forelse ($modules as $module)
                @livewire('elearning.modules.index', ['module' => $module], key($module->id))
            @empty
                <div class="empty-result">
                    Aucun Module
                </div>
            @endforelse
        </div>
    </div>

</div>
