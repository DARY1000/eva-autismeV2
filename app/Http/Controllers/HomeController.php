<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Media;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::upcoming()->take(3)->get();

        $galleryPhotos = Media::where('type', 'photo')
            ->where('album', 'accueil')
            ->ordered()
            ->take(4)
            ->get();

        return view('pages.home', compact('upcomingEvents', 'galleryPhotos'));
    }
}
