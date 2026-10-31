@extends('layouts.app')

@section('title', 'Suivi de votre commande')

@section('content')
<section class="section" style="min-height:40vh;"></section>

<x-payment-status :record="$order" :status-url="route('boutique.statut', $order->reference)" :retry-url="route('boutique.index')">
    <x-slot:pending>Confirmez votre paiement de <strong>{{ number_format($order->total, 0, ',', ' ') }} F CFA</strong> sur votre téléphone ou sur la page de votre opérateur.</x-slot:pending>
    <x-slot:completed>Merci ! Votre commande de <strong>{{ number_format($order->total, 0, ',', ' ') }} F CFA</strong> est confirmée. Nous vous contactons pour organiser la remise.</x-slot:completed>
</x-payment-status>
@endsection
