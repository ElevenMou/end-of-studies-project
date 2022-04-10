<div class="right-card">
    <div class="right-card-title">
        Documents
    </div>
    @forelse ($docs as $doc)
        <div class="doc">
            <a href="{{ $doc->url }}" target="_blank" class="right-card-element">
                {{ $doc->titre }}
            </a>
            @if ($doc->user_id == Auth::id() || Auth::user()->isModerator)
                <button class="delete-doc" wire:click.prevent="delete({{$doc->id}})">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            @endif
        </div>
    @empty
        <div class="empty-doc">
            Aucun documents
        </div>
    @endforelse

    @if (!$create && $user == Auth::user())
        <button class="create-doc-btn" wire:click.prevent="create()">
            créer un document
        </button>
    @endif


    @if ($create)
        @livewire('profile.create-document', ['user' => $user], key($user->id))
    @endif
</div>
