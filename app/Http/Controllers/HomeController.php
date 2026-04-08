<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::upcoming()->take(3)->get();
        return view('pages.home', compact('upcomingEvents'));
    }
}
