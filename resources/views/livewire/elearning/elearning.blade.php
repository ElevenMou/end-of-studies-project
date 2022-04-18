<div class="container">
    @if ($userType == 0)
        @livewire('elearning.etudiants.index')
    @else
        @livewire('elearning.enseignants.index')
    @endif
</div>
