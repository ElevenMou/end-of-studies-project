<nav>

    <header>
        <div class="fixer"></div>
        <a href="{{ route('home') }}"><i class="fas fa-book-reader"></i>{{ config('app.name', 'DISTANCE') }}</a>
        <button class="toggle-button mobile">
            <i class="fas fa-times"></i>
        </button>
        <button class="toggle-button desktop">
            <i class="fas fa-bars"></i>
        </button>
    </header>

    <section class="nav-content">
        <ul>
            <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                <li>

                    <i class="fas fa-newspaper"></i><span class="nav-title">Accueil</span>

                </li>
            </a>
            @if (Auth::check())

                {{-- --------------------------- ETUDIENTS + ENSEIGNANT -------------------------------- --}}

                @if ($user->type != 2)

                    @if ($user->statu == 1)
                        {{-- active users --}}
                        <a href="{{ route('follow') }}" class="{{ request()->is('suivre') ? 'active' : '' }}">
                            <li>
                                <i class="fa-solid fa-user-group"></i><span class="nav-title">Activité
                            </li>
                        </a>
                        <a href="{{ route('elearning') }}"
                            class="{{ request()->is('elearning', 'elearning/*') ? 'active' : '' }}">
                            <li>
                                <i class="fa-solid fa-chalkboard"></i><span class="nav-title">E-learning
                            </li>
                        </a>
                    @elseif($user->statu == 3)
                        {{-- suspdre users --}}
                        <a href="{{ route('elearning') }}"
                            class="{{ request()->is('elearning', 'elearning/*') ? 'active' : '' }}">
                            <li>
                                <i class="fa-solid fa-chalkboard"></i><span class="nav-title">E-learning
                            </li>
                        </a>
                    @endif
                    {{-- --------------------------- ADMIN -------------------------------- --}}
                @elseif($user->type == 2)
                    <a href="{{ route('etudiants') }}" class="{{ request()->is('etudiants') ? 'active' : '' }}">
                        <li>
                            <i class="fa-solid fa-user-graduate"></i><span class="nav-title">Etudiants</span>
                        </li>
                    </a>

                    <a href="{{ route('enseignants') }}"
                        class="{{ request()->is('enseignants') ? 'active' : '' }}">
                        <li>
                            <i class="fa-solid fa-user-tie"></i><span class="nav-title">Enseignants</span>
                        </li>
                    </a>

                @endif {{-- USER TYPE --}}

                {{-- --------------------------- MODERATORS -------------------------------- --}}

                @if ($user->isModerator)
                    <a href="{{ route('reports') }}" class="{{ request()->is('rapports') ? 'active' : '' }}">
                        <li>

                            <i class="fa-solid fa-triangle-exclamation"></i><span class="nav-title">Rapports</span>

                        </li>
                    </a>
                @endif {{-- MODERATOR --}}

                {{-- --------------------------- AUTH USERS -------------------------------- --}}

                <a wire:click.prevent="logout()">
                    <li>
                        <i class="fas fa-sign-out-alt"></i><span class="nav-title">Déconnexion</span>
                    </li>
                </a>

            @endif {{-- AUTH CHECK --}}

        </ul>

    </section>

    <footer>
        @guest

            <a href="{{ route('authentification') }}">
                <button class="btn white">
                    <i class="fas fa-sign-in-alt"></i><span class="sign-in">Connexion</span>
                </button>
            </a>
        @else
            <a class="nav-profile" href="{{ route('profile', $user->id) }}">
                <div class="profile-img">
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Profile">
                </div>
                <div class="person-details">
                    <h3 class="person-nom">{{ ucfirst($user->nom) }} {{ ucfirst($user->prenom) }}</h3>
                    <h3 class="person-prf">
                        @if ($user->type == 0)
                            Etudient
                        @elseif($user->type == 1)
                            Prof
                        @else
                            Admin
                        @endif
                    </h3>
                </div>
            </a>


        @endguest

    </footer>
</nav>
