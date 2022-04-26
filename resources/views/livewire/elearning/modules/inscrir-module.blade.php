<div class="iscrir">
    @if (!$inscrir)
        @if ($module->lock)
            @if ($access)
                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input id="password" type="text" class="form-item" wire:model.debounce.800ms="password" />
                    @if (!$passwordCheck)
                        <div class="form-err">
                            <p> Mot de passe est faux</p>
                        </div>
                    @endif
                </div>
                <button class="action edit" wire:click.prevent="inscrir()">
                    <i wire:loading wire:target="inscrir" class="fa-solid fa-spinner spin"></i> inscrire
                </button>
                <button class="action secondary" wire:click.prevent="access()">
                    <i wire:loading wire:target="access" class="fa-solid fa-spinner spin"></i> Annuler
                </button>
            @else
                <button class="action edit" wire:click.prevent="access()">
                    <i wire:loading wire:target="access" class="fa-solid fa-spinner spin"></i> inscrire
                </button>
            @endif
        @else
            <button class="action edit" wire:click.prevent="inscrir()">
                <i wire:loading wire:target="inscrir" class="fa-solid fa-spinner spin"></i> inscrire
            </button>
        @endif
    @else
        <button class="action white" disabled>
            inscrit
        </button>
    @endif


</div>
