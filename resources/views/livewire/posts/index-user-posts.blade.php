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
                    <button>
                        <i class="far fa-share-square"></i>
                    </button>
                    <button>
                        <span class="post-counter">65</span><i class="far fa-comment-dots"></i>
                    </button>
                    @livewire('posts.like', ['post_id' => $post->id])
                </div>
            </div>
            <div class="post-comments">
                <p class="cmnt">
                    Les commentaires
                </p>
                <div class="comment">
                    <div class="cmnt-header">
                        <div class="cmnt-person">
                            <div class="cmnt-img">
                                <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="profile">
                            </div>

                            <div class="person-detail">
                                <div class="person-nom">Moussa Saidi</div>
                                <div class="person-prof">Etudient</div>
                            </div>
                        </div>

                    </div>
                    <div class="cmnt-content">
                        <pre>
this first comment in this site sandla alnr lner aefb kaerhf hfkshdfiahiefaskjdfiuwGER igeri GEIRG irgWEIGIuef tetr t ergerg erg qer g fgq etg rg e erg dfgd r g d
I hope the idea works.</pre>
                    </div>
                    <div class="cmnt-foot">
                        <div class="cmnt-react">
                            <button id="cmnt-like">J'aime</button>
                            <p>56</p>
                        </div>
                        <p class="cmnt-date">il y a 3min</p>
                    </div>
                </div>
            </div>
        </div>

    @empty
    <div class="empty-result">
        Utilisateur n'a aucun publicataions!
    </div>
    @endforelse
</div>
