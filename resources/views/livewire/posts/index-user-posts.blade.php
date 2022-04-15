<div class="posts">

    @forelse ($posts as $post)
        @livewire('posts.index-post', ['post_id' => $post->id], key($post->id))

    @empty

        <div class="empty-result">
            Aucun publicataions!
        </div>
    @endforelse

    @if ($postsCount > $postsPerPage)
        <button class="load-more" wire:click.prevent="loadMore()">
            voir plus <i class="fa-solid fa-spinner spin" wire:loading wire:target="loadMore"></i>
        </button>
    @elseif($postsCount != 0)
    <div class="empty-result">
        il ne reste plus de publicataions
    </div>
    @endif

</div>
