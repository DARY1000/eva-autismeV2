<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'EVA Autisme - ONG béninoise dédiée à l\'inclusion des personnes autistes. Sensibilisation, orientation, soutien familial au Bénin.')">
    <meta name="keywords" content="autisme, Bénin, inclusion, TSA, ONG, EVA Autisme, enfants autistes">
    <meta property="og:title" content="@yield('title', 'EVA Autisme') | Espoir Vie Avec Autisme">
    <meta property="og:description" content="@yield('meta_description', 'ONG béninoise pour l\'inclusion des personnes autistes')">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Accueil') | EVA Autisme - Bénin</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')
</head>
<body>

<!-- ===================== TOP BAR ===================== -->
<div class="topbar">
    <div class="container">
        <div class="topbar-slogan">
            <span>Un monde</span> où chaque enfant autiste a sa place
        </div>
        <div class="topbar-contact">
            <a href="mailto:infos@eva-autisme.org">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
                infos@eva-autisme.org
            </a>
            <a href="tel:+22901951738038">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.37 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 6 6l.96-.96a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
                +229 01 95 17 38 38
            </a>
        </div>
    </div>
</div>

<!-- ===================== NAVBAR ===================== -->
<nav class="navbar">
    <div class="navbar-inner">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="navbar-logo">
            <img src="{{ asset('images/logo-eva.png') }}" alt="EVA Autisme" class="logo-img">
        </a>

        <!-- Menu -->
        <ul class="navbar-menu" id="navbar-menu">
            <li class="nav-close-item">
                <button class="nav-close-btn" id="nav-close-btn" aria-label="Fermer le menu">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </li>

            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    Accueil
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->is('a-propos*') ? 'active' : '' }}">
                    À Propos
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                </a>
                <ul class="dropdown">
                    <li><a href="{{ route('about.qui-sommes-nous') }}">Qui sommes-nous</a></li>
                    <li><a href="{{ route('about.histoire') }}">Notre Histoire</a></li>
                    <li><a href="{{ route('about.impact') }}">Notre Impact</a></li>
                    <li><a href="{{ route('about.demarche') }}">Notre Démarche</a></li>
                    <li><a href="{{ route('about.faq') }}">FAQ</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->is('nos-actions*') ? 'active' : '' }}">
                    Nos Actions
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                </a>
                <ul class="dropdown">
                    <li><a href="{{ route('actions.projets') }}">Nos Projets</a></li>
                    <li><a href="{{ route('actions.realisations') }}">Nos Réalisations</a></li>
                    <li><a href="{{ route('actions.formation') }}">Formation</a></li>
                    <li><a href="{{ route('actions.evenements') }}">Nos Événements</a></li>
                    <li><a href="{{ route('actions.club-parents') }}">Club Parents</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->is('nos-ressources*') ? 'active' : '' }}">
                    Nos Ressources
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                </a>
                <ul class="dropdown">
                    <li><a href="{{ route('resources.publications') }}">Nos Publications</a></li>
                    <li><a href="{{ route('resources.medias') }}">Médias</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                    Contactez-nous
                </a>
            </li>

        </ul>

        <!-- CTA Don + Burger -->
        <div style="display:flex; align-items:center; gap:0.75rem;">
            <a href="{{ route('don') }}" class="btn-don">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                Faire un Don
            </a>
            <button class="navbar-burger" id="navbar-burger" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</nav>
<div id="nav-overlay" style="position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:999;display:none;transition:opacity 0.3s;"></div>
<style>#nav-overlay.active{display:block!important;}.navbar.scrolled{box-shadow:0 4px 20px rgba(0,0,0,0.12);}.reveal{opacity:0;transform:translateY(28px);transition:opacity 0.6s ease,transform 0.6s ease;}.reveal.revealed{opacity:1;transform:none;}</style>

<!-- ===================== MAIN CONTENT ===================== -->
<main>
    @if(session('success'))
    <div style="max-width:1200px;margin:1rem auto;padding:0 1.5rem;">
        <div class="alert alert-success">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    </div>
    @endif
    @if(session('error'))
    <div style="max-width:1200px;margin:1rem auto;padding:0 1.5rem;">
        <div class="alert alert-error">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            {{ session('error') }}
        </div>
    </div>
    @endif
    @yield('content')
</main>

<!-- ===================== FOOTER ===================== -->
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Brand -->
            <div class="footer-brand">
                <img src="{{ asset('images/logo-eva.png') }}" alt="EVA Autisme" class="logo-img-footer">
                <p style="color:rgba(255,255,255,0.88);">
                    L'ONG EVA Autisme (Espoir Vie Avec Autisme) est une organisation béninoise dédiée à l'inclusion des personnes autistes. Nous agissons pour la sensibilisation, l'orientation et le soutien des familles au Bénin.
                </p>
                <div class="social-links mt-2">
                    <a href="#" class="social-link fb" aria-label="Facebook" title="ONG EVA AUTISME OFFICIEL">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="#" class="social-link ig" aria-label="Instagram" title="ONG EVA AUTISME OFFICIEL">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <a href="#" class="social-link tk" aria-label="TikTok" title="ONG EVA AUTISME OFFICIEL">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V9.15a8.16 8.16 0 0 0 4.77 1.52V7.22a4.85 4.85 0 0 1-1-.53z"/></svg>
                    </a>
                    <a href="https://wa.me/22901951738038" class="social-link wa" aria-label="WhatsApp" title="+229 01 95 17 38 38">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.096.548 4.06 1.503 5.763L.057 23.75l6.14-1.424A11.936 11.936 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.917 0-3.7-.493-5.246-1.354l-.376-.211-3.648.846.873-3.551-.226-.375A10 10 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Liens rapides -->
            <div class="footer-col">
                <h5>Liens Rapides</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('about.qui-sommes-nous') }}">Qui sommes-nous</a></li>
                    <li><a href="{{ route('about.histoire') }}">Notre Histoire</a></li>
                    <li><a href="{{ route('actions.projets') }}">Nos Projets</a></li>
                    <li><a href="{{ route('actions.evenements') }}">Nos Événements</a></li>
                    <li><a href="{{ route('resources.publications') }}">Publications</a></li>
                    <li><a href="{{ route('resources.medias') }}">Médias</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            <!-- Nos Actions -->
            <div class="footer-col">
                <h5>Nos Actions</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('actions.formation') }}">Formation</a></li>
                    <li><a href="{{ route('actions.realisations') }}">Nos Réalisations</a></li>
                    <li><a href="{{ route('actions.club-parents') }}">Club Parents</a></li>
                    <li><a href="{{ route('about.demarche') }}">Notre Démarche</a></li>
                    <li><a href="{{ route('about.impact') }}">Notre Impact</a></li>
                    <li><a href="{{ route('don') }}">Faire un Don</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="footer-col">
                <h5>Contact</h5>
                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span>Abomey-Calavi, Bénin</span>
                </div>
                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.37 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 6 6l.96-.96a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    <a href="tel:+22901951738038">+229 01 95 17 38 38</a>
                </div>
                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    <a href="mailto:infos@eva-autisme.org">infos@eva-autisme.org</a>
                </div>

                <!-- Newsletter -->
                <div style="margin-top:1.5rem;padding-top:1.25rem;border-top:1px solid rgba(255,255,255,0.12);">
                    <p style="color:rgba(255,255,255,0.9);font-size:0.82rem;font-weight:600;margin-bottom:0.75rem;display:flex;align-items:center;gap:6px;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#6bc0e7" stroke-width="2" style="width:15px;height:15px;flex-shrink:0"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        Newsletter
                    </p>
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" style="display:flex;flex-direction:column;gap:0.5rem;">
                        @csrf
                        <input type="email" name="email" placeholder="Votre adresse email…" required
                               style="padding:0.6rem 0.9rem;border-radius:8px;border:1px solid rgba(255,255,255,0.2);background:rgba(255,255,255,0.08);color:#fff;font-size:0.82rem;font-family:inherit;outline:none;width:100%;transition:border-color 0.2s;"
                               onfocus="this.style.borderColor='#6bc0e7'" onblur="this.style.borderColor='rgba(255,255,255,0.2)'">
                        <button type="submit"
                                style="background:#6bc0e7;color:#0d3d6b;font-weight:700;border:none;border-radius:8px;padding:0.6rem 1rem;font-size:0.82rem;font-family:inherit;cursor:pointer;transition:background 0.2s;display:flex;align-items:center;justify-content:center;gap:6px;"
                                onmouseover="this.style.background='#4da8d4'" onmouseout="this.style.background='#6bc0e7'">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                            S'inscrire
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <span>© {{ date('Y') }} ONG EVA Autisme – Bénin</span>
            <span style="opacity:0.3;">·</span>
            <a href="{{ route('mentions-legales') }}" style="color:rgba(255,255,255,0.45);transition:color 0.2s" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.45)'">Mentions légales</a>
            <span style="opacity:0.3;">·</span>
            <a href="{{ route('politique-confidentialite') }}" style="color:rgba(255,255,255,0.45);transition:color 0.2s" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.45)'">Confidentialité</a>
        </div>
    </div>
</footer>

<!-- Lightbox -->
<div class="lightbox-overlay" id="lightbox">
    <div class="lightbox-inner">
        <button class="lightbox-close">✕</button>
        <img src="" alt="Media EVA Autisme">
    </div>
</div>

<!-- WhatsApp floating button -->
<a href="https://wa.me/22995173838" target="_blank" rel="noopener noreferrer" class="whatsapp-float" aria-label="Contactez-nous sur WhatsApp">
    <svg viewBox="0 0 24 24" fill="#fff" xmlns="http://www.w3.org/2000/svg">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>
    </svg>
</a>

<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
