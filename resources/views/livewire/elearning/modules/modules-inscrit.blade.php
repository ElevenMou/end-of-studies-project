<div class="modules-card">
    <h2>Modules inscrit</h2>
    <div class="modules">
        @forelse ($modules as $module)
            @livewire('elearning.modules.index', ['module' => $module], key($module->id))
        @empty
            <div class="empty-result">
                Aucun Module inscrit
            </div>
        @endforelse
    </div>
</div>
