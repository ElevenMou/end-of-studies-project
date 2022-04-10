@if ($following)
    <button class="action following" wire:click.prevent="cancelFollow()">
        Abonné(e)
    </button>
@else
    <button class="action follow" wire:click.prevent="follow()">
        <i class="fa-solid fa-circle-plus fa-beat"></i> S'abonner
    </button>
@endif
