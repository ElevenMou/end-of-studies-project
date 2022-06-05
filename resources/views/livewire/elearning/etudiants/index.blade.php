<div class="container">

    @livewire('elearning.modules.modules-inscrit')

    <div class="modules-card">
        <h2>{{ strtoupper(Auth::user()->filiere) }} Modules</h2>
        <div class="modules">
            @forelse ($modules as $module)
                @livewire('elearning.modules.index', ['module' => $module])
            @empty
                <div class="empty-result">
                    Aucun Module
                </div>
            @endforelse
        </div>
    </div>

</div>
