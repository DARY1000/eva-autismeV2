@extends('layouts.app')

@section('title', 'Boutique')
@section('meta_description', 'La boutique de l\'ONG EVA Autisme : produits sensoriels, pictogrammes et guides. Chaque achat soutient nos actions au Bénin.')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Boutique</h1>
        <p>Des outils utiles au quotidien. Chaque achat soutient les actions d'EVA Autisme au Bénin.</p>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Accueil</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px"><polyline points="9 18 15 12 9 6"/></svg>
            <span>Boutique</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="shop-filters">
            <a href="{{ route('boutique.index') }}" @class(['is-active' => ! $category])>Tout</a>
            @foreach($categories as $key => $label)
                <a href="{{ route('boutique.index', ['categorie' => $key]) }}" @class(['is-active' => $category === $key])>{{ $label }}</a>
            @endforeach
        </div>

        @if($products->isEmpty())
            <div class="shop-empty">
                <h2>{{ $category ? 'Aucun produit dans cette catégorie pour le moment' : 'Nos premiers produits arrivent bientôt' }}</h2>
                <p>Vous cherchez un outil précis ? Écrivez-nous, nous vous orienterons.</p>
                <a href="{{ route('contact') }}" class="btn btn-blue">Nous contacter</a>
            </div>
        @else
            <div class="shop-grid">
                @foreach($products as $product)
                    <a href="{{ route('boutique.show', $product) }}" class="shop-card">
                        <div class="shop-card-img">
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" loading="lazy">
                            @endif
                            @unless($product->is_available)<span>Épuisé</span>@endunless
                        </div>
                        <small>{{ $categories[$product->category] ?? '' }}</small>
                        <h3>{{ $product->name }}</h3>
                        <strong>{{ $product->price_label }}</strong>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>

@endsection
