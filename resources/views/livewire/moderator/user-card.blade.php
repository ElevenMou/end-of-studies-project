<div class="user">
    <div class="user-profile">
        <div class="img-container">
            <img src="{{ asset('storage/'. $user->avatar) }}" alt="profile img">
        </div>
        <div class="user-details">
            <div class="user-name">
                {{ ucfirst($user->nom) }} {{ ucfirst($user->prenom) }}
            </div>
            <div class="user-filiere">
                {{ $user->filiere }}
            </div>
        </div>
    </div>
    <button class="action secondary">
        Suspendre
    </button>
</div>
