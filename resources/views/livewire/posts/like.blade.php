<button class="post-reaction" wire:click.prevent="like()">
    <span class="post-counter">{{ $likesCount }}</span>
    @if ($isLiked)
        <i class="fa-solid fa-heart"></i>
    @else
        <i class="far fa-heart"></i>
    @endif
</button>
