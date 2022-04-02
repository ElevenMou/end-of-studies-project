<div class="form-container">
    <form class="form" wire:submit.prevent="login">
        <h2> Connexion </h2>

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

        <button class="btn secondary" type="submit">Connexion</button>

        <div class="form-text">
            <p>Vous n'avez pas un compte? <a wire:click.prevent="showRegisterForm()">Registre</a></p>
        </div>

</div>

</div>
