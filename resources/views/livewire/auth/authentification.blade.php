<div class="container">
    @if ($form == 1)
        @livewire('auth.login')
    @else
        @livewire('auth.register')
    @endif
</div>
