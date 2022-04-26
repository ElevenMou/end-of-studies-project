<div class="container">
    <div class="search-card">
        <div class="search">
            <label for="search">Trouver un(e) enseignant</label>
            <div class="search-group">
                <input type="text" id="search" placeholder="Recherche par matricule" wire:model.lazy="search">
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
            <button class="action {{ $userStatu == 1 ? 'active' : '' }}" wire:click.prevent="indexUsers()">
                Les enseignants ({{ $usersCount }})
            </button>
            <button class="action {{ $userStatu == 3 ? 'active' : '' }}" wire:click.prevent="usersSuspend()">
                Les enseignants suspendu ({{ $suspendCount }})
            </button>
        </div>
        <div class="loading-msg" wire:loading wire:target="usersSuspend">
            <i class="fa-solid fa-spinner spin"></i> Chargement
        </div>
        <div class="loading-msg" wire:loading wire:target="indexUsers">
            <i class="fa-solid fa-spinner spin"></i> Chargement
        </div>
    </div>
    @if ($newUser)
        <div class="create-ens">
            <button class="ens-btn close" wire:click.prevent="newUser()"> Fermer </button>
        </div>
    @else
        <div class="create-ens">
            <button class="ens-btn create" wire:click.prevent="newUser()"> Ajouter enseignant </button>
        </div>
    @endif

    @if ($newUser)
        @livewire('enseignants.create')
    @endif

    <table>
        <thead>
            <tr>
                <th>
                    Matricule
                </th>
                <th>
                    Nom
                </th>
                <th>
                    Prénom
                </th>
                <th>
                    Email
                </th>
                <th>
                    Departement
                </th>
                @if ($userStatu == 4)
                    <th>
                        Statu
                    </th>
                @endif
                <th>
                    Action
                </th>
            </tr>
        </thead>
        <tbody wire:loading.class="loading">
            @forelse ($users as $user)
                <tr>

                    <td>
                        <a href="{{ route('profile', $user->id) }}">
                            {{ $user->identifiant }}
                        </a>
                    </td>
                    <td>
                        {{ $user->nom }}
                    </td>
                    <td>
                        {{ $user->prenom }}
                    </td>

                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->filiere }}
                    </td>
                    @if ($userStatu == 4)
                        <td>
                            @if ($user->statu == 1)
                                <span class="active">active</span>
                            @elseif($user->statu == 3)
                                <span class="suspendu">suspendu</span>
                            @endif
                        </td>
                    @endif
                    <td>
                        {{-- POUR LES FONCTIONS --}}
                        <button type="hidden"></button>
                        @if ($userStatu == 1)
                            @if ($user->isModerator)
                                <button wire:click.prevent="removeModerator({{ $user->id }})"
                                    class="action accepter">
                                    <i class="fa-solid fa-circle-check"></i><span>moderator</span>
                                </button>
                            @else
                                <button wire:click.prevent="makeModerator({{ $user->id }})"
                                    class="action refuser">
                                    <i class="fa-solid fa-ban"></i><span>moderator</span>
                                </button>
                            @endif
                            <button wire:click.prevent="suspendre({{ $user->id }})" class="action secondary">
                                <i class="fa-solid fa-ban"></i><span>suspendre</span>
                            </button>
                        @elseif($userStatu == 3)
                            <button wire:click.prevent="continuer({{ $user->id }})" class="action accepter">
                                <i class="fa-solid fa-circle-check"></i><span>continuer</span>
                            </button>
                        @elseif($userStatu == 4)
                            @if ($user->statu == 1)
                                <button wire:click.prevent="suspendre({{ $user->id }})" class="action secondary">
                                    <i class="fa-solid fa-circle-check"></i><span>suspendre</span>
                                </button>
                            @elseif($user->statu == 3)
                                <button wire:click.prevent="continuer({{ $user->id }})" class="action accepter">
                                    <i class="fa-solid fa-circle-check"></i><span>continuer</span>
                                </button>
                            @endif
                        @endif
                    </td>
                </tr>

            @empty
                <tr class="empty">
                    @if ($userStatu == 1)
                        <td colspan="6">
                            Aucun Enseignant!
                        </td>
                    @elseif($userStatu == 3)
                        <td colspan="6">
                            Aucun suspendre Enseignant!
                        </td>
                    @elseif($userStatu == 4)
                        <td colspan="7">
                            Cette matricule n'appartient à aucun enseignant de la base de données!
                        </td>
                    @endif


                </tr>
            @endforelse

        </tbody>
    </table>
    @if ($userStatu == 1 && $usersCount != 0 && $usersCount > $usersPerPage)
        <button class="load-more" wire:click.prevent="loadMore()">
            Voir plus etudiants <i class="fa-solid fa-spinner spin" wire:loading wire:target="loadMore"></i>
        </button>
    @elseif($userStatu == 3 && $suspendCount != 0 && $suspendCount > $usersPerPage)
        <button class="load-more" wire:click.prevent="loadMore()">
            Voir plus suspendre etudiants <i class="fa-solid fa-spinner spin" wire:loading wire:target="loadMore"></i>
        </button>
    @endif

</div>
