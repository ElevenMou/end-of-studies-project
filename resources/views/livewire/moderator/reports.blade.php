<div class="container">
    <div class="reports-header">
        <div class="reports-nav">
            <button class="preports-item {{ $pageStatu == 0 ? 'active' : '' }}" wire:click.prevent="posts()" {{ $pageStatu == 0 ? 'disabled' : '' }}>
                Publications
            </button>
            <button class="preports-item {{ $pageStatu == 1 ? 'active' : '' }}" wire:click.prevent="users()" {{ $pageStatu == 1 ? 'disabled' : '' }}>
                Utilisateurs
            </button>
        </div>
    </div>
    <div class="loading-msg" wire:loading>
        Chargement rapports <i class="fa-solid fa-spinner spin"></i>
    </div>
    @if ($pageStatu == 0)
        <div class="posts" wire:loading.remove>
            @forelse ($posts as $post)
                <div class="reports-count">
                    <div class="count">
                        Rapports : {{ $post->reports }}
                    </div>
                </div>
                @livewire('posts.index-post', ['post_id' => $post->id], key($post->id))
            @empty
                <div class="empty-result" wire:loading.remove>
                    Aucun nouveaux reports!
                </div>
            @endforelse
        </div>
    @else
        @forelse ($users as $user)
            <div class="reports-count" wire:loading.remove>
                <div class="count">
                    Rapports : {{ $user->reports }}
                </div>
            </div>
            <div class="cards" wire:loading.remove>
                @livewire('moderator.user-card', ['user_id' => $user->id], key($user->id))
            </div>
        @empty
            <div class="empty-result" wire:loading.remove>
                Aucun nouveaux reports!
            </div>
        @endforelse
    @endif
</div>
