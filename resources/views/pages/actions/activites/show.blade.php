@extends('layouts.app')

@section('title', $activity->title)
@section('meta_description', Str::limit($activity->summary, 155))

@section('styles')
<style>
.activity-head { padding:4rem 0 3rem;color:#fff; }
.activity-head h1 { color:#fff;font-size:2.1rem;margin:0.6rem 0 1rem; }
.activity-head a { color:rgba(255,255,255,0.85);font-size:0.88rem; }
.activity-head-tag { display:inline-block;background:rgba(255,255,255,0.15);font-size:0.75rem;font-weight:700;padding:3px 12px;border-radius:30px; }
.activity-facts { display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem;background:var(--primary-light);border-radius:var(--radius-lg);padding:1.25rem 1.5rem;margin-bottom:2rem; }
.activity-facts dt { font-size:0.75rem;font-weight:700;color:var(--primary);text-transform:uppercase;letter-spacing:0.5px; }
.activity-facts dd { margin:0.15rem 0 0;font-size:0.92rem; }
.activity-cover { width:100%;border-radius:var(--radius-lg);margin-bottom:2rem; }
.activity-content p { margin-bottom:1rem; }
.activity-gallery { display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:0.75rem; }
.activity-gallery button { border:0;padding:0;background:none;cursor:zoom-in;border-radius:var(--radius);overflow:hidden;aspect-ratio:4/3; }
.activity-gallery img { width:100%;height:100%;object-fit:cover;display:block; }
#activity-lightbox { border:0;padding:0;background:transparent;max-width:92vw;max-height:92vh; }
#activity-lightbox::backdrop { background:rgba(0,0,0,0.85); }
#activity-lightbox img { max-width:92vw;max-height:88vh;display:block;border-radius:var(--radius); }
#activity-lightbox button { position:fixed;top:1rem;right:1rem;background:#fff;border:0;border-radius:50%;width:42px;height:42px;font-size:1.3rem;cursor:pointer; }
</style>
@endsection

@section('content')
<section class="activity-head band">
    <div class="container-sm">
        <a href="{{ route('actions.activites') }}">← Toutes nos activités</a><br><br>
        <span class="activity-head-tag">{{ $activity->category_label }} · {{ $activity->year }}</span>
        <h1>{{ $activity->title }}</h1>
    </div>
</section>

<section class="section">
    <div class="container-sm">
        <dl class="activity-facts">
            <div><dt>Date</dt><dd>{{ $activity->period_label }}</dd></div>
            @if($activity->location)<div><dt>Lieu</dt><dd>{{ $activity->location }}</dd></div>@endif
            @if($activity->organizer)<div><dt>Organisateur</dt><dd>{{ $activity->organizer }}</dd></div>@endif
            @if($activity->theme)<div><dt>Thème</dt><dd>{{ $activity->theme }}</dd></div>@endif
        </dl>

        @if($activity->cover_image)
            <img class="activity-cover" src="{{ asset('storage/'.$activity->cover_image) }}" alt="{{ $activity->title }}">
        @endif

        <p style="font-size:1.08rem;">{{ $activity->summary }}</p>

        @if($activity->content)
            <div class="activity-content">{!! str($activity->content)->sanitizeHtml() !!}</div>
        @endif

        @if($activity->video_url)
            <p><a href="{{ $activity->video_url }}" class="btn btn-blue btn-sm" target="_blank" rel="noopener noreferrer">Voir la vidéo</a></p>
        @endif

        @if($activity->gallery)
            <h2 style="margin:2.5rem 0 1rem;font-size:1.4rem;">Photos</h2>
            <div class="activity-gallery">
                @foreach($activity->gallery as $i => $photo)
                    <button type="button" data-full="{{ asset('storage/'.$photo) }}" aria-label="Agrandir la photo {{ $i + 1 }}">
                        <img src="{{ asset('storage/'.$photo) }}" alt="{{ $activity->title }}, photo {{ $i + 1 }}" loading="lazy">
                    </button>
                @endforeach
            </div>
            <dialog id="activity-lightbox">
                <button type="button" aria-label="Fermer">×</button>
                <img src="" alt="">
            </dialog>
        @endif

        @if($related->isNotEmpty())
            <h2 style="margin:3rem 0 1rem;font-size:1.3rem;">Autres activités de {{ $activity->year }}</h2>
            <ul>
                @foreach($related as $item)
                    <li><a href="{{ route('actions.activites.show', $item) }}">{{ $item->title }}</a></li>
                @endforeach
            </ul>
        @endif
    </div>
</section>
@endsection

@section('scripts')
<script>
(function () {
    const box = document.getElementById('activity-lightbox');
    if (!box) return;
    const img = box.querySelector('img');
    document.querySelectorAll('.activity-gallery button').forEach(btn => btn.addEventListener('click', () => {
        img.src = btn.dataset.full;
        box.showModal();
    }));
    box.querySelector('button').addEventListener('click', () => box.close());
    box.addEventListener('click', e => { if (e.target === box) box.close(); });
})();
</script>
@endsection
