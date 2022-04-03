<div class="container">
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
                        <i class="fa-solid fa-circle-check"></i>
                        <i class="fa-solid fa-circle-xmark"></i>
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
