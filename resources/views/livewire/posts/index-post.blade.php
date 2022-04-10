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
        <div class="post-actions">

            @if ($post->user->type != 2)
                <div class="post-action">
                    @if (!Auth::user()->isModerator && $post->user_id != Auth::id() && $post->user->type != 1)
                        @livewire('posts.report-post', ['post_id' => $post->id], key($post->id))
                    @endif
                    @if (Auth::user()->isModerator || Auth::id() == $post->user_id)
                        @livewire('posts.delete-post', ['post_id' => $post->id], key($post->id))
                    @endif
                </div>
            @else
                <div class="post-action">
                    @if (Auth::user()->type == 2)
                        @livewire('posts.delete-post', ['post_id' => $post->id], key($post->id))
                    @endif
                </div>
                <div class="fixer"></div>
            @endif
            <div class="post-reactions">
                @livewire('posts.share-post', ['post_id' => $post->id], key($post->id))
                @livewire('posts.like', ['post_id' => $post->id], key($post->id))
            </div>
        </div>
    </div>
    @livewire('posts.comment', ['post_id' => $post->id], key($post->id))
</div>
