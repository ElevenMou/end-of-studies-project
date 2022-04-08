<div class="action-post">
    <abbr title="Signaler">
        <button class="action signaler" wire:click.prevent="report()">
            <i class="fa-solid fa-triangle-exclamation"></i> Signaler
        </button>
    </abbr>

    @if ($confirm)
        <div class="confirm">
            <div class="confirm-card">
                @if ($done)
                    <div class="confirm-msg">
                        vous avez signalé cet utilisateur!
                    </div>
                    <div class="confirm-actions">
                        <button class="btn secondary" wire:click.prevent="report()">
                            Fermer
                        </button>
                    </div>
                @else
                    <div class="confirm-msg">
                        Signaler cet utilisateur ?
                    </div>
                    <div class="confirm-actions">
                        <button class="btn primary" wire:click.prevent="confirmReport()">
                            <i wire:loading wire:target="confirmReport" class="fa-solid fa-spinner spin"></i> Signaler
                        </button>
                        <button class="btn secondary" wire:click.prevent="report()">
                            Annuler
                        </button>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
