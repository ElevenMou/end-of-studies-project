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
        @endif
    @endguest
</div>
