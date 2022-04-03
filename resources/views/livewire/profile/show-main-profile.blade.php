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

        <div class="description">
            {{ $user->description }}
        </div>

        <div class="profile-actions">

            <a href="{{ route('profile.edit', $user->profile) }}" class="action edit"> Editer profil </a>

        </div>

    </header>


    <main>

        <section class="left">

            <!----------------------CREER POST------------------------>
            @livewire('posts.create-post')

        </section>
        <section class="right">


            <div class="right-card">
                <div class="right-card-title">
                    Information
                </div>
                <a class="right-card-element" target="_blank"> {{ $user->email }} </a>
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
