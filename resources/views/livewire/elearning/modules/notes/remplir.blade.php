<div class="container">
    <div class="search-card">
        <div class="search">
            <label for="search">Trouver un(e) etudient</label>
            <div class="search-group">
                <input type="text" id="search" placeholder="Recherche par apogée" wire:model.lazy="apogee">
                <button class="search-btn" wire:click.prevent="search()">Recherche</button>
            </div>
            <div class="loading-msg" wire:loading wire:target="searchUser">
                <i class="fa-solid fa-spinner spin"></i> recherche
            </div>
            @error('search')
                <div class="validation-err">
                    {{ $message }}
                </div>
            @enderror
        </div>
        @if (!$noteForm)
            <div class="actions">
                <div class="action editer" wire:click.prevent="noteForm()">
                    Ajouter ou modifier notes
                </div>
            </div>
        @endif

    </div>
    @if ($noteForm)
        @livewire('elearning.modules.notes.create-or-update', ['module_id' => $module->id])
    @endif

    @livewire('elearning.modules.notes.table', ['module' => $module])


</div>
