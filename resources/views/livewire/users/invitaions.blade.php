<div class="container">
    <div class="incription-header">
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
                <button class="action accepter"><i class="fa-solid fa-user-plus"></i> accepter</button>
                <button class="action refuser"><i class="fa-solid fa-ban"></i> supprimer</button>
            </div>
        </div>
    @empty
        @if ($pageStatu == 1)
        <div class="empty-invitation">
            Vous n'avez aucun nouveaux invitaions
        </div>
        @else
        <div class="empty-invitation">
            Ce apogée n'appartient à aucun etudiant de la base de données!
        </div>
        @endif
    @endforelse
</div>
