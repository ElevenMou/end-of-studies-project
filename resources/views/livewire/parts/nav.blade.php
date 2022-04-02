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
                @if ($user->statu == 1 && $user->type == 0)
                    <a href="elearning.php" class="{{ request()->is('/elearning') ? 'active' : '' }}">
                        <li>

                            <i class="fas fa-chalkboard-teacher"></i><span class="nav-title">E-learning</span>

                        </li>
                    </a>
                    <a href="questions.php" class="{{ request()->is('/question') ? 'active' : '' }}">
                        <li>

                            <i class="fas fa-question-circle"></i><span class="nav-title">Questions</span>

                        </li>
                    </a>
                    <a href="notes.php" class="{{ request()->is('/resources') ? 'active' : '' }}">
                        <li>

                            <i class="fas fa-envelope-open-text"></i><span class="nav-title">Resources</span>

                        </li>
                    </a>
                @elseif($user->type == 2)
                <a href="{{ route('inscription') }}" class="{{ request()->is('/resources') ? 'active' : '' }}">
                    <li id="gestion">

                        <i class="fa-solid fa-users"></i><span class="nav-title">Etudients</span>

                    </li>
                </a>
                @endif
                <a wire:click.prevent="logout()" class="{{ request()->is('/resources') ? 'active' : '' }}">
                    <li>

                        <i class="fas fa-sign-out-alt"></i><span class="nav-title">Déconnexion</span>

                    </li>
                </a>
            @endif

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
            <a class="profile" href="#">
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
