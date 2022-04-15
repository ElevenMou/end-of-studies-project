<div class="post-comments">
    @if (!empty($comments))
        <p class="cmnt">
            Les commentaires <span class="cmnt-counter">{{ $commentsCount }}</span> <i
                class="far fa-comment-dots"></i>
        </p>
    @endif
    @livewire('posts.create-comment', ['post' => $post])
    @forelse ($comments as $comment)
        <div class="comment" wire:loading.class="loading" wire:target="deleteComment">
            <div class="cmnt-header">
                <a href="{{ route('profile', $comment->user->id) }}" class="cmnt-person">
                    <div class="cmnt-img">
                        <img src="{{ asset('storage/' . $comment->user->avatar) }}" alt="profile">
                    </div>

                    <div class="person-detail">
                        <div class="person-nom">{{ ucfirst($comment->user->nom) }}
                            {{ ucfirst($comment->user->prenom) }}</div>
                        <div class="person-prof">
                            @if ($comment->user->type == 0)
                                Etudient
                            @elseif ($comment->user->type == 1)
                                Prof
                            @else
                                Admin
                            @endif
                        </div>
                    </div>
                </a>

                @if (Auth::id() == $comment->user->id)
                    <button class="cmnt-trash" wire:click.prevent="deleteComment({{ $comment->id }})">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                @endif

            </div>
            <div class="cmnt-content">
                <pre>{{ $comment->contenu }}</pre>
            </div>
            <div class="cmnt-foot">
                @livewire('posts.like-comment', ['cmnt_id' => $comment->id], key($comment->id))
                <p class="cmnt-date">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
        </div>
    @empty
        <div class="empty-cmnt">
            Aucun commentaires
        </div>
    @endforelse
    @if ($commentsCount > $commentsPerPage)
        <button class="load-more-cmnt" wire:click.prevent="loadMore()">
            voir plus ({{ $commentsLeft }}) <i class="fa-solid fa-spinner spin" wire:loading
                wire:target="loadMore"></i>
        </button>
    @endif

</div>
