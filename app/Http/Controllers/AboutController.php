<?php
namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\Partner;

class AboutController extends Controller
{
    public function quiSommesNous()
    {
        $teamMembers = TeamMember::where('is_active', true)->orderBy('order')->get();
        return view('pages.about.qui-sommes-nous', compact('teamMembers'));
    }

    public function histoire()
    {
        return view('pages.about.histoire');
    }

    public function impact()
    {
        return view('pages.about.impact');
    }

    public function demarche()
    {
        $partners = Partner::where('is_active', true)->orderBy('order')->get();
        return view('pages.about.demarche', compact('partners'));
    }

    public function faq()
    {
        return view('pages.about.faq');
    }
}
