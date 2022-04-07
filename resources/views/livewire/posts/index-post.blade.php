<div class="post">
    <div class="post-header">
        <a href="{{ route('profile', $post->user->id) }}">
            <div class="person">
                <div class="img-container">
                    <img src="
                    {{ asset('storage/' . $post->user->avatar) }}
                    " alt="Profile picture">
                </div>
                <div class="def">
                    <div class="nom">
                        {{ ucfirst($post->user->prenom) }} {{ ucfirst($post->user->nom) }}
                    </div>
                    <div class="type">
                        @if ($post->user->type == 0)
                            Etudient
                        @elseif($post->user->type == 1)
                            Prof
                        @else
                            Admin
                        @endif
                    </div>
                </div>
            </div>
        </a>
        <div class="created-at">
            {{ $post->created_at->diffForHumans() }}
        </div>
    </div>
    <div class="post-main">
        <div class="post-content">
            <pre class="text-box"> {{ $post->contenu }} </pre>
            @if ($post->image)
                <div class="post-img">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="post iamge">
                </div>
            @endif
        </div>
        <div class="post-reactions">

            @livewire('posts.share-post', ['post_id' => $post->id], key($post->id))
            @livewire('posts.like', ['post_id' => $post->id], key($post->id))

        </div>


    </div>
    @livewire('posts.comment', ['post_id' => $post->id], key($post->id))
</div>
