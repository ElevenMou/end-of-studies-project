<div class="new-note-container">
    <div class="note-form">
        @if ($session)
            @if (session()->has('danger'))
                <div class="alert danger">
                    <button wire:click.prevent="closeSession">X</button>
                    <p>{{ session()->get('danger') }}</p>
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert success">
                    <button wire:click.prevent="closeSession">X</button>
                    <p>{{ session()->get('success') }}</p>
                </div>
            @endif
        @endif
        <div class="form-group">
            <label for="apogee" class="form-label">Apogee</label>
            <input type="text" class="form-item" id="apogee" wire:model.debounce.800ms="apogee">
            @error('apogee')
                <div class="form-err">
                    <p> {{ $message }}</p>
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="noteN" class="form-label">Normale</label>
            <input type="number" max="20" min="0" class="form-item" id="noteN" wire:model.debounce.800ms="noteN">
            @error('noteN')
                <div class="form-err">
                    <p> {{ $message }}</p>
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="noteR" class="form-label">Rattrapage</label>
            <input type="number" max="20" min="0" class="form-item" id="noteR" wire:model.debounce.800ms="noteR">
            @error('noteR')
                <div class="form-err">
                    <p> {{ $message }}</p>
                </div>
            @enderror
        </div>
    </div>
    <div class="note-acion">
        <button class="action accepter" wire:click.prevent="save()">
            Sauvgarder
        </button>
        <div class="action follow" wire:click.prevent="closeForm()">
            Annuler
        </div>
    </div>
</div>
