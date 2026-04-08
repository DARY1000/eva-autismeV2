<?php
namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class DonController extends Controller
{
    public function index()
    {
        return view('pages.don');
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'montant'   => 'required|numeric|min:500',
            'frequence' => 'required|in:ponctuel,mensuel',
            'prenom'    => 'required|string|max:100',
            'nom'       => 'required|string|max:100',
            'email'     => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'pays'      => 'nullable|string|max:100',
            'message'   => 'nullable|string|max:1000',
        ]);

        $donation = Donation::create([
            'prenom'    => $validated['prenom'],
            'nom'       => $validated['nom'],
            'email'     => $validated['email'],
            'telephone' => $validated['telephone'],
            'pays'      => $validated['pays'] ?? 'Bénin',
            'montant'   => $validated['montant'],
            'frequence' => $validated['frequence'],
            'message'   => $validated['message'] ?? null,
            'status'    => 'pending',
            'reference' => 'DON-'.strtoupper(Str::random(8)),
        ]);

        Log::info('New donation', ['ref' => $donation->reference, 'montant' => $donation->montant]);

        return redirect()->route('don')
            ->with('success', 'Merci pour votre générosité ! Référence: '.$donation->reference.'. Notre équipe vous contactera pour finaliser le paiement.');
    }
}
