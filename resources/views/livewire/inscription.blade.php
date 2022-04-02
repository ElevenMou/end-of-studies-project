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
            Les etudients
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
                        <button class="action accepter">
                            <i class="fa-solid fa-circle-check"></i><span>accepter</span>
                        </button>
                        <button class="action refuser">
                            <i class="fa-solid fa-circle-xmark"></i><span>refuser</span>
                        </button>
                    </td>
                </tr>
            @empty
                <div class="empty">
                    Aucun Etudient!
                </div>
            @endforelse

        </tbody>
    </table>
    <button class="load-more" wire:click.prevent="loadMore()">
        Voir plus
    </button>
</div>
