@php($user = filament()->auth()->user())
@if($user)
    <div class="eva-sidebar-user">
        <span class="eva-avatar">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</span>
        <a href="{{ filament()->getProfileUrl() }}" title="Mon profil et mot de passe">
            <strong>{{ $user->name }}</strong>
            <small>{{ $user->isAdmin() ? 'Administrateur' : 'Éditeur' }} · Mon profil</small>
        </a>
        <form method="POST" action="{{ filament()->getLogoutUrl() }}">
            @csrf
            <button type="submit" aria-label="Se déconnecter" title="Se déconnecter">
                <x-heroicon-o-arrow-right-on-rectangle />
            </button>
        </form>
    </div>
@endif
