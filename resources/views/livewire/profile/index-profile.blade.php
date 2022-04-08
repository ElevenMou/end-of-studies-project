<div class="profile">

    <!------------------------Header------------------------->

    <header>

        @if ($editMode)
            <div class="profile-avatar">
                @if ($avatar)
                    <img src="{{ $avatar->temporaryUrl() }}">
                @else
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="avatar">
                @endif
                @error('photo')
                    <span class="desc-err">{{ $message }}</span>
                @enderror

            </div>
            <label for="avatar" class="edit-avatar">Choisir un image</label>
            <input id="avatar" type="file" wire:model="avatar">
        @else
            <div class="profile-avatar">
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="avatar.jpg">
            </div>
        @endif
        <div class="person-nom">
            {{ ucfirst($user->nom) }} {{ ucfirst($user->prenom) }}
        </div>

        <div class="person-type">
            @if ($user->type == 0)
                Etudient
            @elseif($user->type == 1)
                Prof
            @else
                Admin
            @endif
        </div>

        @if ($editMode)
            <textarea placeholder="Profil description..." class="desc-edit" wire:model="description">
            </textarea>
            @error('description')
                <div class="desc-err">
                    <p> {{ $message }}</p>
                </div>
            @enderror
            <div class="profile-actions">
                <button class="action edit" wire:click.prevent="edit()">
                    <i wire:loading.remove wire:target="edit" class="fa-solid fa-floppy-disk"></i>
                    <i class="fa-solid fa-spinner spin" wire:loading wire:target="edit"></i> Enregistrer
                </button>
                <button class="action signaler" wire:click.prevent="editMode()">
                    <i class="fa-solid fa-ban"></i> Annuler
                </button>
            </div>
        @else
            <div class="description">
                {{ $user->description }}
            </div>
        @endif
        <div class="profile-actions">
            @if ($main)
                <button class="action edit" wire:click.prevent="editMode()"> Modifier profil </button>
            @else
                @if ($user->type != 2 && $auth_user->type != 2)
                    @if ($following)
                        <button class="action following" wire:click.prevent="cancelFollow()">
                            Abonné(e)
                        </button>
                    @else
                        <button class="action follow" wire:click.prevent="follow()">
                            <i class="fa-solid fa-circle-plus fa-beat"></i> S'abonner
                        </button>
                    @endif
                    @livewire('profile.report-profile', ['user_id' => $user->id], key($user->id))
                @endif

            @endif
        </div>
        @if ($user->type != 2)
            <div class="follow-count">
                <div class="counter">
                    {{ $followersCount }} Abonnés
                </div>
                <div class="conuter">
                    {{ $followingCount }} Abonnements
                </div>
            </div>
            @if ($follower)
                <div class="person-type">
                    {{ ucfirst($user->prenom) }} est t'abonné(e)
                </div>
            @endif
        @endif


    </header>

    @if ($session)
        @if (session()->has('success'))
            <div class="alert success">
                <button wire:click.prevent="closeSession">X</button>
                <p>{{ session()->get('success') }}</a>
                </p>
            </div>
        @endif
    @endif

    <main>

        <section class="left">

            <!----------------------CREER POST------------------------>

            @if ($main)
                @livewire('posts.create-post')
            @endif
            @livewire('posts.index-user-posts', ['user_id' => $user->id])

        </section>
        <section class="right">


            <div class="right-card">
                <div class="right-card-title">
                    Informations
                </div>
                <p class="right-card-element"> {{ $user->email }} </p>
                @if ($user->type == 0)
                    <p class="right-card-element">Filiere : {{ $user->filiere }}</p>
                @elseif($user->type == 1)
                    <p class="right-card-element"> Departement : {{ $user->filiere }} </p>
                @endif
            </div>

            <div class="right-card">
                <div class="right-card-title">
                    Documents
                </div>
                <a href="#" class="right-card-element"> Document 1 </a>
                <a href="#" class="right-card-element"> Document 2 </a>
                <a href="#" class="right-card-element"> Document 3 </a>
                <a href="#" class="right-card-element"> Document 4 </a>

            </div>


        </section>
    </main>
</div>
