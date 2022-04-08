<div class="action-post">
    <abbr title="supprimer">
        <button class="action report" wire:click.prevent="delete()">
            <i class="fa-regular fa-trash-can"></i>
        </button>
    </abbr>

    @if ($confirm)
        <div class="confirm">
            <div class="confirm-card">
                @if ($done)
                    <div class="confirm-msg">
                        publication est supprimée!
                    </div>
                    <div class="confirm-actions">
                        <button class="btn secondary" wire:click.prevent="delete()">
                            Fermer
                        </button>
                    </div>
                @else
                    <div class="confirm-msg">
                        Supprimer cette publication ?
                    </div>
                    <div class="confirm-actions">
                        <button class="btn primary" wire:click.prevent="confirmDelete()">
                            <i wire:loading wire:target="confirmDelete" class="fa-solid fa-spinner spin"></i> Supprimer
                        </button>
                        <button class="btn secondary" wire:click.prevent="delete()">
                            Annuler
                        </button>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
