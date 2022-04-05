<div class="container">
    <div class="search-card">
        <div class="search">
            <label for="search">Trouver un etudiant</label>
            <div class="search-group">
                <input type="text" id="search" placeholder="Recherche par apogée" wire:model.lazy="search">
                <button class="search-btn" wire:click.prevent="searchUser()">Recherche</button>
            </div>
            <div class="loading-msg" wire:loading wire:target="searchUser">
                <i class="fa-solid fa-spinner spin"></i> recherche
            </div>
            @error('search')
                <div class="validation-err">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="users-nav">
            <button class="action {{ $pageStatu == 0 ? 'active' : '' }}" wire:click.prevent="invitation()">
                Abonnés ({{$followersCount }})
            </button>
            <button class="action {{ $pageStatu == 1 ? 'active' : '' }}" wire:click.prevent="amis()">
                Abonnements ({{ $followingCount }})
            </button>
        </div>
    </div>

    @forelse($users as $user)
        <div class="invitation-card">
            <div class="sender-info">
                <div class="sender-avatar">
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="avatar">
                </div>
                <div class="sender-details">
                    <div class="sender-name">
                        {{ ucfirst($user->nom) }} {{ ucfirst($user->prenom) }}
                    </div>
                    <div class="sender-filiere">
                        {{ $user->filiere }}
                    </div>
                </div>
            </div>
            <div class="invitation-action">
                @if ($pageStatu == 0)
                    <button class="action accepter" wire:click.prevent="abonner({{ $user->id }})"><i
                            class="fa-solid fa-user-plus"></i> Abonner
                    </button>
                    <button class="action refuser"><i class="fa-solid fa-ban"></i> supprimer</button>
                @elseif($pageStatu == 1)
                    <button class="action refuser"><i class="fa-solid fa-ban"></i> supprimer</button>
                @endif

            </div>
        </div>
    @empty
        @if ($pageStatu == 0)
            <div class="empty-result">
                Vous n'avez aucun nouveaux invitaions!
            </div>
        @elseif($pageStatu == 1)
            <div class="empty-result">
                Vous n'avez aucun ami!
            </div>
        @else
            <div class="empty-result">
                Ce apogée n'appartient à aucun etudiant de la base de données!
            </div>
        @endif
    @endforelse

</div>
