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
    <td>
        <button class="action follow" wire:click.prevent="modifier({{$etudient->id}})">
            modifier
        </button>
    </td>
</tr>
