<div class="form-container">
    <form class="form" wire:submit.prevent="registerUser" enctype="multipart/form-data">
        <h2> Créer Un Compte </h2>

        <div class="form-group">
            <label for="apogee" class="form-label">Apogée </label>
            <input id="apogee" type="text" class="form-item" wire:model.debounce.800ms="identifiant" />

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
            <label for="filiere" class="form-label">Filière </label>
            <select class="form-item" id="filiere" wire:model.debounce.800ms="filiere">
                <option value="null">Choisir filiere</option>
                <option value="smi">SMI</option>
                <option value="sma">SMA</option>
                <option value="smp">SMP</option>
                <option value="smc">SMC</option>
                <option value="svi">SVI</option>
                <option value="stu">STU</option>
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
            <label for="avatar" class="up-avatar">Avatar</label>
            <input id="avatar" type="file" class="avatar-input" wire:model.debounce.800ms="avatar" />
            <div wire:loading wire:target="avatar" class="form-label">Téléchargement...</div>
            @if ($avatar)
                <div class="avatar-preview">
                    <img src="{{ $avatar->temporaryUrl() }}">
                </div>
            @endif

            @error('avatar')
                <div class="form-err">
                    <p> {{ $message }}</p>
                </div>
            @enderror
        </div>
        <button class="btn secondary" type="submit">Registre</button>

        <div class="form-text">
            <p>Vous avez deja un compte? <a wire:click.prevent="showLoginForm()">Connexion</a></p>
        </div>
        @if ($session)
            @if (session()->has('success'))
                <div class="alert success">
                    <button wire:click.prevent="closeSession">X</button>
                    <p>{{ session()->get('success') }} <a class="action"
                            wire:click.prevent="showLoginForm()">Login</a></p>
                </div>
            @endif
        @endif

</div>
