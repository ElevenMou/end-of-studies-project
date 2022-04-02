<div class="container">
    <div class="incription-header">
        <div class="search">
            <label for="search">Trouver un etudiant</label>
            <div class="search-group">
                <input type="text" id="search" placeholder="Recherche par apogée" wire:model="search">
                <button class="search-btn" wire:click.prevent="searchUser()">Recherche</button>
            </div>
            @error('search')
                <div class="validation-err">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="users-nav">
            @if ($userStatu == 0)
                <button class="action" wire:click.prevent="indexUsers()">
                    Les etudiants ({{ $usersCount }})
                </button>
                <button class="action" wire:click.prevent="usersSuspend()">
                    Etudients suspendu ({{ $suspendCount }})
                </button>
            @elseif($userStatu == 1)
                <button class="action" wire:click.prevent="usersDemande()">
                    Demande d'inscription ({{ $demandeCount }})
                </button>
                <button class="action" wire:click.prevent="usersSuspend()">
                    Etudients suspendu ({{ $suspendCount }})
                </button>
            @elseif($userStatu == 3)
                <button class="action" wire:click.prevent="indexUsers()">
                    Les etudiants ({{ $usersCount }})
                </button>
                <button class="action" wire:click.prevent="usersDemande()">
                    Demande d'inscription ({{ $demandeCount }})
                </button>
            @elseif($userStatu == 4)
                <button class="action" wire:click.prevent="indexUsers()">
                    Les etudiants ({{ $usersCount }})
                </button>
                <button class="action" wire:click.prevent="usersDemande()">
                    Demande d'inscription ({{ $demandeCount }})
                </button>
                <button class="action" wire:click.prevent="usersSuspend()">
                    Etudients suspendu ({{ $suspendCount }})
                </button>
            @endif
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
        <tbody>
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
                            @if ($user->statu == 1)
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
                            @if ($user->statu == 1)
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
            Voir plus des demandes
        </button>
    @elseif($userStatu == 1 && $usersCount != 0 && $usersCount > $usersPerPage)
        <button class="load-more" wire:click.prevent="loadMore()">
            Voir plus etudiants
        </button>
    @elseif($userStatu == 3 && $suspendCount != 0 && $suspendCount > $usersPerPage)
        <button class="load-more" wire:click.prevent="loadMore()">
            Voir plus suspendre etudiants
        </button>
    @endif

</div>
