<?php
namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email|max:255']);

        Newsletter::firstOrCreate(
            ['email' => $request->email],
            ['is_active' => true, 'token' => Str::random(32)]
        );

        return redirect()->back()->with('success', 'Merci ! Vous êtes maintenant inscrit(e) à notre newsletter.');
    }
}
