<?php
namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\ClubMember;
use App\Models\Contact;
use App\Models\Formation;
use App\Models\Project;
use App\Models\Media;
use App\Support\CentreNesa;
use Illuminate\Http\Request;

class ActionsController extends Controller
{
    public function projets()
    {
        $projects = Project::orderBy('order')->get();
        return view('pages.actions.projets', compact('projects'));
    }

    public function centre()
    {
        return view('pages.actions.centre', [
            'zones'      => CentreNesa::ZONES,
            'principles' => CentreNesa::DESIGN_PRINCIPLES,
            'alignment'  => CentreNesa::ALIGNMENT,
            'sources'    => CentreNesa::SOURCES,
        ]);
    }

    public function activites(Request $request)
    {
        $year     = $request->integer('annee') ?: null;
        $category = array_key_exists((string) $request->query('categorie'), Activity::CATEGORIES)
            ? $request->query('categorie')
            : null;

        $activitiesByYear = Activity::published()
            ->when($year, fn ($query) => $query->whereYear('start_date', $year))
            ->when($category, fn ($query) => $query->where('category', $category))
            ->latestFirst()
            ->get()
            ->groupBy('year');

        return view('pages.actions.activites.index', [
            'activitiesByYear' => $activitiesByYear,
            'years'            => Activity::years(publishedOnly: true),
            'categories'       => Activity::CATEGORIES,
            'year'             => $year,
            'category'         => $category,
        ]);
    }

    public function activite(Activity $activity)
    {
        abort_unless($activity->is_published, 404);

        $related = Activity::published()
            ->whereYear('start_date', $activity->year)
            ->whereKeyNot($activity->id)
            ->latestFirst()
            ->take(5)
            ->get();

        return view('pages.actions.activites.show', compact('activity', 'related'));
    }

    public function realisations()
    {
        $photos = Media::where('type', 'photo')->orderBy('order')->take(12)->get();
        return view('pages.actions.realisations', compact('photos'));
    }

    public function formation()
    {
        $formations = Formation::where('is_active', true)->orderBy('order')->get();
        return view('pages.actions.formation', compact('formations'));
    }

    public function registerFormation(Request $request)
    {
        $validated = $request->validate([
            'nom'            => 'required|string|max:100',
            'prenom'         => 'required|string|max:100',
            'email'          => 'required|email|max:255',
            'telephone'      => 'required|string|max:20',
            'organisation'   => 'nullable|string|max:255',
            'type_formation' => 'required|string|max:100',
            'message'        => 'nullable|string|max:1000',
        ]);

        Contact::create([
            'name'         => $validated['prenom'].' '.$validated['nom'],
            'email'        => $validated['email'],
            'phone'        => $validated['telephone'],
            'organization' => $validated['organisation'] ?? null,
            'subject'      => 'Inscription formation : '.$validated['type_formation'],
            'message'      => $validated['message'] ?: 'Demande d\'inscription à la formation.',
            'ip_address'   => $request->ip(),
        ]);

        return redirect()->route('actions.formation')
            ->with('success', 'Votre inscription a bien été reçue ! Nous vous contacterons rapidement.');
    }

    public function evenements()
    {
        $upcomingEvents = Event::upcoming()->get();
        $pastEvents     = Event::past()->take(10)->get();
        return view('pages.actions.evenements', compact('upcomingEvents', 'pastEvents'));
    }

    public function registerEvent(Request $request, $eventId)
    {
        $validated = $request->validate([
            'name'                => 'required|string|max:255',
            'email'               => 'required|email|max:255',
            'phone'               => 'required|string|max:20',
            'nombre_participants' => 'required|integer|min:1|max:10',
            'type_participation'  => 'required|in:présentiel,en ligne',
            'message'             => 'nullable|string|max:500',
        ]);

        EventRegistration::create([
            'event_id'            => Event::findOrFail($eventId)->id,
            'name'                => $validated['name'],
            'email'               => $validated['email'],
            'phone'               => $validated['phone'],
            'nombre_participants' => $validated['nombre_participants'],
            'type_participation'  => $validated['type_participation'],
            'message'             => $validated['message'] ?? null,
            'registered_at'       => now(),
        ]);

        return redirect()->route('actions.evenements')
            ->with('success', "Votre inscription a été enregistrée. Nous vous enverrons les détails par email.");
    }

    public function clubParents()
    {
        return view('pages.actions.club-parents');
    }

    public function joinClub(Request $request)
    {
        $validated = $request->validate([
            'nom'               => 'required|string|max:100',
            'prenom'            => 'required|string|max:100',
            'email'             => 'required|email|unique:club_members,email',
            'telephone'         => 'required|string|max:20',
            'ville'             => 'required|string|max:100',
            'situation_enfant'  => 'nullable|string|max:1000',
            'comment_nous_connu'=> 'nullable|string|max:100',
        ]);

        ClubMember::create(array_merge($validated, ['joined_at' => now()]));

        return redirect()->route('actions.club-parents')
            ->with('success', 'Bienvenue dans le Club Parents EVA Autisme ! Nous vous contacterons très prochainement.');
    }
}
