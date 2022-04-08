<div class="cmnt-react">
    <button class="cmnt-like {{ $liked ? 'liked' : '' }}" wire:click.prevent="like()">
        J'aime
    </button>
    <p class="{{ $liked ? 'liked' : '' }}">{{$likesCount}}</p>
</div>
