<div class="profile">

    <!------------------------Header------------------------->

    <header>
        <div class="profile-avatar">
            <img src="{{ asset('storage/' . $user->avatar) }}" alt="default-avatar.jpg">
        </div>

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
                {{ $user->description }}
            </textarea>
            @error('description')
                <div class="desc-err">
                    <p> {{ $message }}</p>
                </div>
            @enderror
            <div class="profile-actions">
                <button class="action edit" wire:click.prevent="edit()"><i class="fa-solid fa-floppy-disk"></i> Enregistrer </button>
                <button class="action signaler" wire:click.prevent="editMode()"><i class="fa-solid fa-ban"></i> Annuler </button>
            </div>
        @else
            <div class="description">
                {{ $user->description }}
            </div>



            <div class="profile-actions">
                @if ($main)
                    <button class="action edit" wire:click.prevent="editMode()"> Editer profil </button>
                @else
                    @if ($user->type == 0)
                        <button class="action ajouter"><i class="fa-solid fa-user-plus"></i> ajouter ami </button>
                        <button class="action signaler"><i class="fa-solid fa-flag"></i> signaler </button>
                    @endif

                @endif
            </div>
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
            @livewire('posts.create-post')

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
