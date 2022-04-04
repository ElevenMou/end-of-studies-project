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
            <button class="action {{ $userStatu == 1 ? 'active' : '' }}" wire:click.prevent="indexUsers()">
                Les etudiants ({{ $usersCount }})
            </button>
            <button class="action {{ $userStatu == 0 ? 'active' : '' }}" wire:click.prevent="usersDemande()">
                Demande d'inscription ({{ $demandeCount }})
            </button>
            <button class="action {{ $userStatu == 3 ? 'active' : '' }}" wire:click.prevent="usersSuspend()">
                Etudients suspendu ({{ $suspendCount }})
            </button>
        </div>
        <div class="loading-msg" wire:loading wire:target="usersSuspend">
            <i class="fa-solid fa-spinner spin"></i> Chargement
        </div>
        <div class="loading-msg" wire:loading wire:target="usersDemande">
            <i class="fa-solid fa-spinner spin"></i> Chargement
        </div>
        <div class="loading-msg" wire:loading wire:target="indexUsers">
            <i class="fa-solid fa-spinner spin"></i> Chargement
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>
                    Apogée
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
                    Filière
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
                        {{ $user->identifiant }}
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
                            @if ($user->statu == 0)
                                <span class="suspendu">demande</span>
                            @elseif ($user->statu == 1)
                                <span class="active">active</span>
                            @elseif($user->statu == 2)
                                <span class="refuser">refuser</span>
                            @elseif($user->statu == 3)
                                <span class="suspendu">suspendu</span>
                            @endif
                        </td>
                    @endif
                    <td>
                        @if ($userStatu == 0)
                            {{-- POUR LES FONCTIONS --}}
                            <button type="hidden"></button>

                            <button wire:click.prevent="accepter({{ $user->id }})" class="action accepter">
                                <i class="fa-solid fa-circle-check"></i><span>accepter</span>
                            </button>

                            <button wire:click.prevent="refuser({{ $user->id }})" class="action refuser">
                                <i class="fa-solid fa-circle-xmark"></i><span>refuser</span>
                            </button>
                        @elseif($userStatu == 1)
                            <button wire:click.prevent="suspendre({{ $user->id }})" class="action secondary">
                                <i class="fa-solid fa-circle-check"></i><span>suspendre</span>
                            </button>
                        @elseif($userStatu == 3)
                            <button wire:click.prevent="continuer({{ $user->id }})" class="action accepter">
                                <i class="fa-solid fa-circle-check"></i><span>continuer</span>
                            </button>
                        @elseif($userStatu == 4)
                            @if ($user->statu == 0)
                                <button wire:click.prevent="accepter({{ $user->id }})" class="action accepter">
                                    <i class="fa-solid fa-circle-check"></i><span>accepter</span>
                                </button>
                                <button wire:click.prevent="refuser({{ $user->id }})" class="action refuser">
                                    <i class="fa-solid fa-circle-xmark"></i><span>refuser</span>
                                </button>
                            @elseif ($user->statu == 1)
                                <button wire:click.prevent="suspendre({{ $user->id }})" class="action secondary">
                                    <i class="fa-solid fa-circle-check"></i><span>suspendre</span>
                                </button>
                            @elseif($user->statu == 2)
                                <button wire:click.prevent="accepter({{ $user->id }})" class="action accepter">
                                    <i class="fa-solid fa-circle-check"></i><span>accepter</span>
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
                    @if ($userStatu == 0)
                        <td colspan="6">
                            Aucun nouveaux demande d'inscription!
                        </td>
                    @elseif($userStatu == 1)
                        <td colspan="6">
                            Aucun Etudient!
                        </td>
                    @elseif($userStatu == 3)
                        <td colspan="6">
                            Aucun suspendre Etudient!
                        </td>
                    @elseif($userStatu == 4)
                        <td colspan="7">
                            Ce apogée n'appartient à aucun etudiant de la base de données!
                        </td>
                    @endif


                </tr>
            @endforelse

        </tbody>
    </table>
    @if ($userStatu == 0 && $demandeCount != 0 && $demandeCount > $usersPerPage)
        <button class="load-more" wire:click.prevent="loadMore()">
            Voir plus des demandes <i class="fa-solid fa-spinner spin" wire:loading wire:target="loadMore"></i>
        </button>
    @elseif($userStatu == 1 && $usersCount != 0 && $usersCount > $usersPerPage)
        <button class="load-more" wire:click.prevent="loadMore()">
            Voir plus etudiants <i class="fa-solid fa-spinner spin" wire:loading wire:target="loadMore"></i>
        </button>
    @elseif($userStatu == 3 && $suspendCount != 0 && $suspendCount > $usersPerPage)
        <button class="load-more" wire:click.prevent="loadMore()">
            Voir plus suspendre etudiants <i class="fa-solid fa-spinner spin" wire:loading wire:target="loadMore"></i>
        </button>
    @endif

</div>
