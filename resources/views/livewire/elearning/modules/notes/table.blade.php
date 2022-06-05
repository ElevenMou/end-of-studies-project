<div class="container">
    <table class="table-note">
        <thead>
            <tr>
                <th>
                    Apogee
                </th>
                <th>
                    Nom
                </th>
                <th>
                    Prénom
                </th>
                <th>
                    Normale
                </th>
                <th>
                    Rattrapage
                </th>
            </tr>
        </thead>
        <tbody wire:loading.class="loading">
            @forelse ($etudients as $etudient)
                <tr>
                    <td>
                        {{ $etudient->identifiant }}
                    </td>
                    <td>
                        {{ $etudient->nom }}
                    </td>
                    <td>
                        {{ $etudient->prenom }}
                    </td>
                    <td>
                        @if ($etudient->noteN)
                            {{ $etudient->noteN }}
                        @endif
                    </td>
                    <td>
                        @if ($etudient->noteR)
                            {{ $etudient->noteR }}
                        @endif
                    </td>
                </tr>

            @empty
                <tr class="empty">
                    Aucun Result!
                </tr>
            @endforelse
        </tbody>
    </table>
    @if ($count != 0 && $count > $etudientsPerPage && !$search)
        <button class="load-more" wire:click.prevent="loadMore()">
            Voir plus etudiants <i class="fa-solid fa-spinner spin" wire:loading wire:target="loadMore"></i>
        </button>
    @endif
    @if ($search)
        <button class="btn secondary" wire:click.prevent="clearSearch()">
            Clear recherche <i class="fa-solid fa-spinner spin" wire:loading wire:target="clearSearch"></i>
        </button>
    @endif
</div>
