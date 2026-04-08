<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'subject'      => 'required|string|max:200',
            'prenom'       => 'required|string|max:100',
            'nom'          => 'required|string|max:100',
            'email'        => 'required|email|max:255',
            'telephone'    => 'nullable|string|max:20',
            'organization' => 'nullable|string|max:255',
            'message'      => 'required|string|min:10|max:2000',
        ]);

        Contact::create([
            'name'         => $validated['prenom'].' '.$validated['nom'],
            'email'        => $validated['email'],
            'phone'        => $validated['telephone'] ?? null,
            'organization' => $validated['organization'] ?? null,
            'subject'      => $validated['subject'],
            'message'      => $validated['message'],
            'ip_address'   => $request->ip(),
        ]);

        Log::info('Contact form', ['email' => $validated['email'], 'subject' => $validated['subject']]);

        return redirect()->route('contact')
            ->with('success', 'Votre message a bien été envoyé ! Nous vous répondrons dans les 48 heures.');
    }
}
