<div class="create-comment">
    <div class="cmnt-group">
        <textarea placeholder="écrire un commentaire" wire:model.debounce.400ms="comment">
    </textarea>
        <button class="save-comment" wire:click.prevent="saveComment()">
            <i wire:loading.remove wire:target="saveComment" class="fa-regular fa-paper-plane"></i>
            <i wire:loading wire:target="saveComment" class="fa-solid fa-spinner spin"></i>
        </button>
    </div>
    <div class="loading-msg" wire:loading wire:target="saveComment">
        <i class="fa-solid fa-spinner spin"></i> Publier
    </div>
    @error('comment')
        <div class="error">
            <p> {{ $message }}</p>
        </div>
    @enderror
    @if ($session)
        @if (session()->has('success'))
            <div class="alert success">
                <button wire:click.prevent="closeSession">X</button>
                <p>{{ session()->get('success') }}</a>
                </p>
            </div>
        @endif
    @endif
    @if ($session)
        @if (session()->has('danger'))
            <div class="alert danger">
                <button wire:click.prevent="closeSession">X</button>
                <p>{{ session()->get('danger') }}</a>
                </p>
            </div>
        @endif
    @endif
</div>
