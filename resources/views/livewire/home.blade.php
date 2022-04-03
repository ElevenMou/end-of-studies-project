<div class="container">
    @guest
        @livewire('posts.admin-posts')
    @else
        @if ($user->statu == 1)
            @livewire('posts.create-post')
            @if ($user->type == 0)
                <div class="posts-type">
                    <button class="type-post {{ $postsType == 0 ? 'active' : '' }}" wire:click.prevent="amisPosts()"
                        {{ $postsType == 0 ? 'disabled' : '' }}>amis</button>
                    <button class="type-post {{ $postsType == 1 ? 'active' : '' }}" wire:click.prevent="profPosts()"
                        {{ $postsType == 1 ? 'disabled' : '' }}>enseignants</button>
                    <button class="type-post {{ $postsType == 2 ? 'active' : '' }}" wire:click.prevent="adminPosts()"
                        {{ $postsType == 2 ? 'disabled' : '' }}>admin</button>
                </div>
                <div class="loading-msg" wire:loading wire:target="amisPosts">
                    Chargement amis publications <i class="fa-solid fa-spinner spin"></i>
                </div>
                <div class="loading-msg" wire:loading wire:target="profPosts">
                    Chargement enseignants publications <i class="fa-solid fa-spinner spin"></i>
                </div>
                <div class="loading-msg" wire:loading wire:target="adminPosts">
                    Chargement admin publications <i class="fa-solid fa-spinner spin"></i>
                </div>
                <div class="container" wire:loading.class="hide">
                    @if ($postsType == 0)
                        @livewire('posts.index-posts')
                    @elseif($postsType == 1)
                        @livewire('posts.index-posts')
                    @else
                        @livewire('posts.admin-posts')
                    @endif
                </div>
            @else
                @livewire('posts.index-posts')
            @endif
        @elseif($user->statu == 0)
            <div class="message danger">
                Votre compte est à l'étude
            </div>
            @livewire('posts.admin-posts')
        @elseif($user->statu == 2)
            <div class="message refuser">
                Votre compte est refuser <a href="#">vérifier vos informations!</a>
            </div>
            @livewire('posts.admin-posts')
        @elseif($user->statu == 3)
            <div class="message refuser">
                Votre compte a été suspendu
            </div>
            @livewire('posts.admin-posts')
        @endif
    @endguest
</div>
