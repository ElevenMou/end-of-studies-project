<div class="container">
    <div class="search-card">
        <div class="search">
            <label for="search">Trouver un utilisateur</label>
            <div class="search-group">
                <input type="text" id="search" placeholder="Recherche par apogée" wire:model.debounce.800ms="search" />
                <button class="search-btn" wire:click.prevent="searchUser()">Recherche</button>
            </div>
            @error('search')
                <div class="validation-err">
                    {{ $message }}
                </div>
            @enderror
            <div class="loading-msg" wire:loading wire:target="searchUser">
                <i class="fa-solid fa-spinner spin"></i> recherche
            </div>
        </div>
    </div>
    @if ($pageStatu == 0)
        <div class="empty-result">
            Trouver utilisateur par apogée!
        </div>
    @else
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
                <div class="empty-result">
                    Ce apogée n'appartient à aucun etudiant de la base de données!
                </div>
            @endforelse
        </div>
    @endif
</div>
