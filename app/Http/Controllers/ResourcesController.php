<?php
namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Media;

class ResourcesController extends Controller
{
    public function publications()
    {
        $publications = Publication::orderByDesc('published_at')->get();
        return view('pages.resources.publications', compact('publications'));
    }

    public function medias()
    {
        $photos    = Media::where('type', 'photo')->orderBy('order')->get();
        $videos    = Media::where('type', 'video')->orderBy('order')->get();
        $creations = Media::where('type', 'creation')->orderBy('order')->get();
        return view('pages.resources.medias', compact('photos', 'videos', 'creations'));
    }
}
