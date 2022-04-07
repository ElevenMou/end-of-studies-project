<div class="container">
    <div class="posts">
        @livewire('posts.index-post', ['post_id' => $post->id], key($post->id))
    </div>
</div>
