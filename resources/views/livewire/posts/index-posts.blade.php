<div class="posts">
    @forelse ($posts as $post)
        <div class="post">
            <div class="post-header">
                <a href="#">
                    <div class="person">
                        <div class="img-container">
                            <img src="
                            {{ asset('storage/' . $post->user->avatar) }}
                            " alt="Profile picture">
                        </div>
                        <div class="def">
                            <div class="nom">{{ ucfirst($post->user->prenom) }}
                                {{ ucfirst($post->user->nom) }}</div>
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
                <div class="post-reaction">
                    <a href="#">
                        <i class="far fa-heart"></i>
                    </a>
                    <a href="post.php">
                        <i class="far fa-comment-dots"></i>
                    </a>
                    <a href="#">
                        <i class="far fa-share-square"></i>
                    </a>
                </div>
            </div>
            <div class="post-footer">
                <p> 542 likes </p>
                <p> 65 comment </p>
                <p> 87 shares </p>
            </div>
        </div>

    @empty
    @endforelse
</div>
