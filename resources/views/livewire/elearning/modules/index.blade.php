<div class="module">
    @if ($session)
        @if (session()->has('success'))
            <div class="alert success">
                <button wire:click.prevent="closeSession">X</button>
                <p>{{ session()->get('success') }}</p>
            </div>
        @endif
    @endif

    @if ($thumbnail && $edit)
        <a href="{{ route('profile', $module->enseignant) }}" class="thumbnail">
            <img src="{{ $thumbnail->temporaryUrl() }}" alt="thumbnail">
        </a>
    @else
        <a href="{{ route('module.show', $module->id) }}" class="thumbnail">
            <img src="{{ asset('storage/' . $module->thumbnail) }}" alt="thumbnail">
        </a>
    @endif

    @if ($edit)
        <div class="form-group">
            <label for="thumbnail" class="edit-thumbnail">Choisir photo</label>
            <input id="thumbnail" type="file" class="thumbnail-input" wire:model.debounce.800ms="thumbnail" />
            <div wire:loading wire:target="thumbnail" class="form-label">Téléchargement...</div>

            @error('thumbnail')
                <div class="form-err">
                    <p> {{ $message }}</p>
                </div>
            @enderror
        </div>
    @endif
    <div class="module-body">
        <div class="module-info">
            {{-- EDIT MODULE --}}
            @if ($edit)
                <div class="form-group">
                    <label for="titre" class="form-label">Titre</label>
                    <input id="titre" type="text" class="form-item" wire:model.debounce.800ms="titre" />
                    @error('titre')
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
                    <label for="semestre" class="form-label">Semestre </label>
                    <select class="form-item" id="semestre" wire:model.debounce.800ms="semestre">
                        <option value="null">Choisir semestre</option>
                        <option value="s1">S1</option>
                        <option value="s2">S2</option>
                        <option value="s3">S3</option>
                        <option value="s4">S4</option>
                        <option value="s5">S5</option>
                        <option value="s6">S6</option>
                    </select>
                    @error('semestre')
                        <div class="form-err">
                            <p> {{ $message }}</p>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lock" class="form-label">Verrouillage <input id="lock" type="checkbox"
                            class="form-item" wire:model="lock" /></label>
                </div>

                @if ($lock)
                    <div class="form-group">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input id="password" type="text" class="form-item" wire:model.debounce.800ms="password" />
                        @error('password')
                            <div class="form-err">
                                <p> {{ $message }}</p>
                            </div>
                        @enderror
                    </div>
                @endif

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" wire:model.debounce.800ms="description">
                </textarea>
                    @error('description')
                        <div class="form-err">
                            <p> {{ $message }}</p>
                        </div>
                    @enderror
                </div>
            @else
                {{-- SHOW MODULE --}}

                <a href="{{ route('module.show', $module->id) }}" class="titre">
                    @if ($module->lock)
                        <i class="fa-solid fa-lock"></i>
                    @endif {{ $module->titre }} -
                    {{ strtoupper($module->filiere . '/' . $module->semestre) }}
                </a>
                <a href="{{ route('profile', $module->enseignant) }}" class="enseignant">
                    {{ $module->user->nom }} {{ $module->user->prenom }}
                </a>
                <p class="enseignant"></p>
                <pre class="description">{{ $module->description }}</pre>

            @endif

        </div>
        <div class="module-actions">
            @if (Auth::id() == $module->enseignant)
                @if ($edit)
                    <button class="action primary" wire:click.prevent="saveModule()">
                        <i wire:loading wire:target="saveModule" class="fa-solid fa-spinner spin"></i>enregistrer
                    </button>
                    <button class="action secondary" wire:click.prevent="edit()">
                        Annuler
                    </button>
                @else
                    <button class="action secondary" wire:click.prevent="edit()">
                        modifier
                    </button>
                    <button class="action delete" wire:click.prevent="deleteModule()">
                        supprimer
                    </button>
                @endif
            @else
                @livewire('elearning.modules.inscrir-module', ['module' => $module], key($module->id))
            @endif
        </div>
    </div>

    @if ($confirm)
        <div class="confirm">
            <div class="confirm-card">
                <div class="confirm-msg">
                    Supprimer cette module ?
                </div>
                <div class="confirm-actions">
                    <button class="btn primary" wire:click.prevent="confirmDelete()">
                        <i wire:loading wire:target="confirmDelete" class="fa-solid fa-spinner spin"></i> Supprimer
                    </button>
                    <button class="btn secondary" wire:click.prevent="deleteModule()">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
