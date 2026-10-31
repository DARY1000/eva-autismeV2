@extends('layouts.app')

@section('title', $product->name)
@section('meta_description', $product->summary)

@section('content')

<section class="section">
    <div class="container">
        <nav class="shop-back"><a href="{{ route('boutique.index') }}">← Retour à la boutique</a></nav>

        <div class="shop-product">
            <div>
                <div class="shop-product-img">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" data-shop-main>
                    @endif
                </div>
                @if($product->gallery)
                    <div class="shop-thumbs">
                        @foreach([$product->image, ...$product->gallery] as $photo)
                            @if($photo)
                                <button type="button" data-shop-thumb="{{ asset('storage/'.$photo) }}"><img src="{{ asset('storage/'.$photo) }}" alt="" loading="lazy"></button>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <div>
                <small class="shop-category">{{ \App\Models\Product::CATEGORIES[$product->category] ?? '' }}</small>
                <h1>{{ $product->name }}</h1>
                <p class="shop-price">{{ $product->price_label }}</p>
                <p>{{ $product->summary }}</p>

                @if($product->is_available)
                    <form action="{{ route('boutique.panier.add', $product) }}" method="POST" class="shop-add">
                        @csrf
                        <label for="quantity">Quantité</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" max="{{ min($product->stock ?? 99, 99) }}" required>
                        <button type="submit" class="btn btn-blue">Ajouter au panier</button>
                    </form>
                    @if($product->stock !== null && $product->stock <= 5)
                        <p class="shop-stock">Plus que {{ $product->stock }} en stock</p>
                    @endif
                @else
                    <p class="shop-stock">Ce produit est épuisé pour le moment.</p>
                @endif

                @if($product->description)
                    <div class="shop-description">{!! $product->description !!}</div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
document.querySelectorAll('[data-shop-thumb]').forEach(thumb => {
    thumb.addEventListener('click', () => { document.querySelector('[data-shop-main]').src = thumb.dataset.shopThumb; });
});
</script>
@endsection
