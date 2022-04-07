<div class="share-post">

    @if ($share)
        <div class="share-link">
            http://127.0.0.1:8000/post/{{ $post_id }}
        </div>
    @endif

    <button class="post-reaction share" wire:click.prevent="share()">
        <i class="far fa-share-square"></i>
    </button>

</div>
