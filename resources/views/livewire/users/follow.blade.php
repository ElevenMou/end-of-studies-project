<div class="container">
    <div class="search-card">

        <a class="search-link" href="{{ route('search') }}">Trouver un utilisateur</a>


        <div class="users-nav">
            <button class="action {{ $pageStatu == 0 ? 'active' : '' }}" wire:click.prevent="followers()">
                Abonnés ({{ $followersCount }})
            </button>
            <button class="action {{ $pageStatu == 1 ? 'active' : '' }}" wire:click.prevent="following()">
                Abonnements ({{ $followingCount }})
            </button>
        </div>
    </div>

    <div class="list-users">
        @forelse($users as $user)
            <a href="{{ route('profile', $user->id) }}" class="user-card">
                <div class="user-info">
                    <div class="user-avatar">
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="avatar">
                    </div>
                    <div class="user-details">
                        <div class="user-name">
                            {{ ucfirst($user->nom) }} {{ ucfirst($user->prenom) }}
                        </div>
                        <div class="user-filiere">
                            {{ $user->filiere }}
                        </div>
                    </div>
                </div>
            </a>
        @empty
            @if ($pageStatu == 0)
                <div class="empty-result">
                    Vous n'avez aucun Abonnés!
                </div>
            @elseif($pageStatu == 1)
                <div class="empty-result">
                    Vous n'avez aucun Abonnements!
                </div>
            @else
                <div class="empty-result">
                    Ce apogée n'appartient à aucun etudiant de la base de données!
                </div>
            @endif
    </div>
    @endforelse
    @if ($pageStatu == 0)
        @if ($usersPerPage < $followersCount)
            <button class="load-more" wire:click.prevent="loadMore()">
                voir plus
            </button>
        @endif
    @elseif ($pageStatu == 1)
        @if ($usersPerPage < $followingCount)
            <button class="load-more" wire:click.prevent="loadMore()">
                voir plus
            </button>
        @endif
    @endif

</div>
