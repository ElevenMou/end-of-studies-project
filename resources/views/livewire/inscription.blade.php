<div class="container">
    <div class="incription-header">
        <div class="search">
            <label for="search">Trouver un etudiant</label>
            <input type="text" id="search" placeholder="Recherche par apogée" wire:model="search">
            @error('search')
                <div class="validation-err">
                    {{ $message }}
                </div>
            @enderror
        </div>
        @if (!$demande)
            <button class="demande" wire:click.prevent="usersDemande()">
                Demande d'inscription ({{ $demandeCount }})
            </button>
        @else
            <button class="demande" wire:click.prevent="indexUsers()">
                Les etudiants ({{ $usersCount }})
            </button>
        @endif

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
                    Filière
                </th>
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
                        {{ $user->filiere }}
                    </td>
                    <td>
                        @if ($demande)
                            {{-- POUR LES FONCTIONS --}}
                            <button type="hidden"></button>

                            <button wire:click.prevent="accepter({{ $user->id }})" class="action accepter">
                                <i class="fa-solid fa-circle-check"></i><span>accepter</span>
                            </button>

                            <button wire:click.prevent="refuser({{ $user->id }})" class="action refuser">
                                <i class="fa-solid fa-circle-xmark"></i><span>refuser</span>
                            </button>
                        @else
                            <button wire:click.prevent="suspendre({{ $user->id }})" class="action secondary">
                                <i class="fa-solid fa-circle-check"></i><span>suspendre</span>
                            </button>
                        @endif

                    </td>
                </tr>

            @empty
                <tr class="empty">
                    @if ($demande)
                        <td colspan="5">
                            Aucun nouveaux demande d'inscription!
                        </td>
                    @else
                        <td colspan="5">
                            Aucun Etudient!
                        </td>
                    @endif


                </tr>
            @endforelse

        </tbody>
    </table>
    @if ($demande && $demandeCount != 0)
        <button class="load-more" wire:click.prevent="loadMore()">
            Voir plus des demandes
        </button>
    @elseif(!$demande && $usersCount != 0)
        <button class="load-more" wire:click.prevent="loadMore()">
            Voir plus etudiants
        </button>
    @endif

</div>
