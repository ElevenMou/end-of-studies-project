<div class="container">
    @guest
        @livewire('posts.admin-posts')
    @else
        @if ($user->statu == 1)
            @livewire('posts.create-post')
            @if ($user->type == 0)
                <div class="posts-type">
                    <button class="type-post" wire:click.prevent="adminPosts()">amis</button>
                    <button class="type-post" wire:click.prevent="adminPosts()">admin</button>
                    <button class="type-post">enseignants</button>
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
