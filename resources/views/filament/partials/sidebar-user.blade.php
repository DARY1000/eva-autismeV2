@php($user = filament()->auth()->user())
@if($user)
    <div class="eva-sidebar-user">
        <span class="eva-avatar">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</span>
        <div>
            <strong>{{ $user->name }}</strong>
            <small>{{ $user->isAdmin() ? 'Administrateur' : 'Éditeur' }}</small>
        </div>
        <form method="POST" action="{{ filament()->getLogoutUrl() }}">
            @csrf
            <button type="submit" aria-label="Se déconnecter" title="Se déconnecter">
                <x-heroicon-o-arrow-right-on-rectangle />
            </button>
        </form>
    </div>
@endif
