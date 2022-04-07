<div class="share-post">

    @if ($share)
        <a href="{{config('app.url')}}post/{{ $post_id }}" class="share-link">
            {{config('app.url')}}post/{{ $post_id }}
        </a>
    @endif

    <button class="post-reaction share" wire:click.prevent="share()">
        <i class="far fa-share-square"></i>
    </button>

</div>
