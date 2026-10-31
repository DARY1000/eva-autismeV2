@extends('layouts.app')

@section('title', 'Suivi de votre don')

@section('content')
<section class="section" style="min-height:40vh;"></section>

<x-payment-status :record="$donation" :status-url="route('don.status', $donation->reference)" :retry-url="route('don')">
    <x-slot:pending>Confirmez votre don de <strong>{{ number_format($donation->montant, 0, ',', ' ') }} F CFA</strong> sur votre téléphone ou sur la page de votre opérateur.</x-slot:pending>
    <x-slot:completed>Merci ! Votre don de <strong>{{ number_format($donation->montant, 0, ',', ' ') }} F CFA</strong> aide directement les enfants autistes et leurs familles au Bénin.</x-slot:completed>
</x-payment-status>
@endsection
