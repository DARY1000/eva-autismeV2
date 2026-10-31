@extends('layouts.app')

@section('title', 'Votre panier')

@section('content')

<section class="section">
    <div class="container-sm">
        <h1 class="shop-title">Votre panier</h1>

        @if($lines->isEmpty())
            <div class="shop-empty">
                <h2>Votre panier est vide</h2>
                <a href="{{ route('boutique.index') }}" class="btn btn-blue">Voir la boutique</a>
            </div>
        @else
            <div class="shop-lines">
                @foreach($lines as $line)
                    <div class="shop-line">
                        <div>
                            <a href="{{ route('boutique.show', $line->product) }}"><strong>{{ $line->product->name }}</strong></a>
                            <small>{{ $line->product->price_label }} l'unité</small>
                        </div>
                        <form action="{{ route('boutique.panier.update', $line->product) }}" method="POST" class="shop-line-form">
                            @csrf
                            @method('PATCH')
                            <label class="sr-only" for="qty-{{ $line->product->id }}">Quantité</label>
                            <input type="number" class="form-control" id="qty-{{ $line->product->id }}" name="quantity" value="{{ $line->quantity }}" min="1" max="{{ min($line->product->stock ?? 99, 99) }}" onchange="this.form.submit()">
                            <button type="submit" name="quantity" value="0" class="shop-remove">Retirer</button>
                        </form>
                        <strong>{{ number_format($line->subtotal, 0, ',', ' ') }} F</strong>
                    </div>
                @endforeach
            </div>

            <div class="shop-total"><span>Total</span><strong>{{ number_format($total, 0, ',', ' ') }} F CFA</strong></div>

            <div class="shop-actions">
                <a href="{{ route('boutique.index') }}" class="btn btn-white-outline">Continuer mes achats</a>
                <a href="{{ route('boutique.commande') }}" class="btn btn-blue">Commander</a>
            </div>
        @endif
    </div>
</section>

@endsection
