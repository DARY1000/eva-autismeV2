<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use App\Support\SpamGuard;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private const SUBJECTS = [
        'Renseignements généraux', 'Devenir partenaire', 'Devenir bénévole',
        'Faire un don', 'Formation', 'Événements', 'Autre',
    ];

    public function index()
    {
        return view('pages.contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'subject'      => 'required|string|in:'.implode(',', self::SUBJECTS),
            'prenom'       => 'required|string|max:100',
            'nom'          => 'required|string|max:100',
            'email'        => 'required|email|max:255',
            'telephone'    => 'nullable|string|max:20',
            'organization' => 'nullable|string|max:255',
            'message'      => 'required|string|min:30|max:2000',
        ], [
            'message.min' => 'Merci de préciser votre demande en quelques phrases.',
        ]);

        $name = $validated['prenom'].' '.$validated['nom'];
        $spam = SpamGuard::inspect($name, $validated['organization'] ?? null, $validated['message']);
        $isSpam = $spam['score'] >= SpamGuard::THRESHOLD;

        Contact::create([
            'name'         => $name,
            'email'        => $validated['email'],
            'phone'        => $validated['telephone'] ?? null,
            'organization' => $validated['organization'] ?? null,
            'subject'      => $validated['subject'],
            'message'      => $validated['message'],
            'status'       => $isSpam ? 'spam' : 'new',
            'spam_reason'  => $isSpam ? implode(', ', $spam['reasons']) : null,
            'ip_address'   => $request->ip(),
        ]);

        return redirect()->route('contact')
            ->with('success', 'Votre message a bien été envoyé ! Nous vous répondrons dans les 48 heures.');
    }
}
