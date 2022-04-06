<div class="posts">
    @forelse ($posts as $post)
        <div class="post">
            <div class="post-header">
                <a href="{{ route('profile', $post->user_id) }}">
                    <div class="person">
                        <div class="img-container">
                            <img src="
                            {{ asset('storage/' . $post->avatar) }}
                            " alt="Profile picture">
                        </div>
                        <div class="def">
                            <div class="nom">{{ ucfirst($post->prenom) }}
                                {{ ucfirst($post->nom) }}</div>
                            <div class="type">
                                @if ($post->type == 0)
                                    Etudient
                                @elseif($post->type == 1)
                                    Prof
                                @else
                                    Admin
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
                <div class="created-at">
                    {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
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
                    <button class="post-reaction">
                        <i class="far fa-share-square"></i>
                    </button>

                    @livewire('posts.like', ['post_id' => $post->id])
                </div>
            </div>

            @livewire('posts.comment', ['post_id' => $post->id])
        </div>
    @empty
        <div class="empty-result">
            Aucun publicataions!
        </div>
    @endforelse
    <button class="load-more" wire:click.prevent="loadMore()">
        voir plus
    </button>
</div>
