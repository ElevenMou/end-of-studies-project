<div class="container">
    @guest
        @livewire('posts.admin-posts')
    @else
        @if ($user->statu == 1)
            @livewire('posts.create-post')
            @livewire('posts.index-posts')
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
        @endif
    @endguest
</div>
