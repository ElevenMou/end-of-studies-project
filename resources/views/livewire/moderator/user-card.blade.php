<div class="user">
    <a href="{{ route('profile', $user->id) }}" class="user-profile">
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
    </a>
    @livewire('moderator.suspendre', ['user' => $user], key($user->id))
</div>
