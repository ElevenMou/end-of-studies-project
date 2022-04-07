<div class="share-post">

    @if ($share)
        <div class="share-link">
            {{config('app.url')}}/{{ $post_id }}
        </div>
    @endif

    <button class="post-reaction share" wire:click.prevent="share()">
        <i class="far fa-share-square"></i>
    </button>

</div>
