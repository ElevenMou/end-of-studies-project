<div class="create-container">
    @if ($session)
        @if (session()->has('success'))
            <div class="alert success">
                <button wire:click.prevent="closeSession">X</button>
                <p>{{ session()->get('success') }}
            </div>
        @endif
    @endif

    <div class="form-group">
        <label for="matricule" class="form-label">Matricule </label>
        <input id="matricule" type="text" class="form-item" wire:model.debounce.800ms="identifiant" />

        @error('identifiant')
            <div class="form-err">
                <p> {{ $message }}</p>
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="prenom" class="form-label">Prénom </label>
        <input id="prenom" type="text" class="form-item" wire:model.debounce.800ms="prenom" />

        @error('prenom')
            <div class="form-err">
                <p> {{ $message }}</p>
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="nom" class="form-label">Nom </label>
        <input id="nom" type="text" class="form-item" wire:model.debounce.800ms="nom" />

        @error('nom')
            <div class="form-err">
                <p> {{ $message }}</p>
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="filiere" class="form-label">Departement </label>
        <select class="form-item" id="filiere" wire:model.debounce.800ms="filiere">
            <option value="null">Choisir departement</option>
            <option value="informatique">Informatique</option>
            <option value="mathematique">Mathematique</option>
            <option value="physique">Physique</option>
            <option value="chimique">Chimique</option>
            <option value="biologie">Biologie</option>
            <option value="giologie">Giologie</option>
        </select>
        @error('filiere')
            <div class="form-err">
                <p> {{ $message }}</p>
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="email" class="form-label">Email </label>
        <input id="email" type="text" class="form-item" wire:model.debounce.800ms="email" />

        @error('email')
            <div class="form-err">
                <p> {{ $message }}</p>
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="password" class="form-label">Mot de passe </label>
        <input id="password" type="password" class="form-item" wire:model.debounce.800ms="password" />
    </div>

    <div class="form-group">
        <label for="password_confirmation" class="form-label">Confirmer mot de passe </label>
        <input id="password_confirmation" type="password" class="form-item"
            wire:model.debounce.800ms="password_confirmation" />

        @error('password')
            <div class="form-err">
                <p> {{ $message }}</p>
            </div>
        @enderror
    </div>

    <div class="form-group">

        <label for="moderator" class="form-label">Moderator <input id="moderator" type="checkbox"
                class="form-item" wire:model.debounce.800ms="isModerator" /></label>
    </div>
    <button class="create-btn" wire:click.prevent="createProf()">
        <i wire:loading wire:target="confirmReport" class="fa-solid fa-spinner spin"></i> Ajouter
    </button>


</div>
