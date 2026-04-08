<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Project;
use App\Models\Event;
use App\Models\Publication;
use App\Models\TeamMember;
use App\Models\Partner;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@eva-autisme.org'],
            [
                'name'     => 'Admin EVA Autisme',
                'password' => Hash::make('EvaAutisme2024!'),
                'role'     => 'admin',
            ]
        );

        // Éditeur
        User::updateOrCreate(
            ['email' => 'editeur@eva-autisme.org'],
            [
                'name'     => 'Éditeur EVA',
                'password' => Hash::make('EvaAutisme2024!'),
                'role'     => 'editor',
            ]
        );

        // Projets
        $projects = [
            [
                'title'       => 'Éco Sens et Autisme',
                'slug'        => 'eco-sens-autisme',
                'description' => 'Sensibilisation des populations béninoises au réchauffement climatique et à ses impacts sur les personnes autistes. Un environnement sain est la base d\'une vie inclusive.',
                'category'    => 'Sensibilisation',
                'status'      => 'active',
                'order'       => 1,
            ],
            [
                'title'       => 'Club Parents EVA Autisme',
                'slug'        => 'club-parents-eva-autisme',
                'description' => 'Espace de rencontre, de soutien et de partage d\'expériences pour les parents d\'enfants autistes. Réunions mensuelles, ateliers pratiques et groupe de parole.',
                'category'    => 'Soutien Familial',
                'status'      => 'active',
                'order'       => 2,
            ],
            [
                'title'       => 'Programme Scolarisation Inclusive',
                'slug'        => 'scolarisation-inclusive',
                'description' => 'Accompagnement des enfants autistes pour leur intégration dans les écoles ordinaires et spécialisées du Bénin. Formation des enseignants aux TSA.',
                'category'    => 'Éducation',
                'status'      => 'active',
                'order'       => 3,
            ],
            [
                'title'       => 'Campagne Nationale Sensibilisation TSA',
                'slug'        => 'campagne-sensibilisation-tsa',
                'description' => 'Campagne de sensibilisation nationale sur les Troubles du Spectre de l\'Autisme dans les écoles, communautés et médias béninois.',
                'category'    => 'Sensibilisation',
                'status'      => 'active',
                'order'       => 4,
            ],
            [
                'title'       => 'Formation Professionnels de Santé',
                'slug'        => 'formation-professionnels-sante',
                'description' => 'Programme de formation destiné aux médecins, infirmiers et travailleurs sociaux pour améliorer le dépistage et l\'accompagnement de l\'autisme au Bénin.',
                'category'    => 'Formation',
                'status'      => 'active',
                'order'       => 5,
            ],
            [
                'title'       => 'Accompagnement à Domicile',
                'slug'        => 'accompagnement-domicile',
                'description' => 'Interventions à domicile pour adapter les solutions disponibles à la réalité de chaque famille et proposer un accompagnement éducatif personnalisé.',
                'category'    => 'Accompagnement',
                'status'      => 'active',
                'order'       => 6,
            ],
        ];

        foreach ($projects as $p) {
            Project::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // Événements
        $events = [
            [
                'title'       => 'Journée de Sensibilisation à l\'Autisme – Abomey-Calavi',
                'slug'        => 'journee-sensibilisation-2026-abomey',
                'description' => 'Grande journée de sensibilisation au TSA avec stands d\'information, témoignages de familles, interventions de spécialistes et activités pour les enfants.',
                'date'        => now()->addDays(13)->setTime(9, 0),
                'location'    => 'Abomey-Calavi',
                'address'     => 'Place de l\'Unité, Abomey-Calavi, Bénin',
                'type'        => 'présentiel',
                'status'      => 'upcoming',
                'is_free'     => true,
                'max_participants' => 500,
            ],
            [
                'title'       => 'Atelier Formation Parents – Comprendre les TSA',
                'slug'        => 'atelier-parents-tsa-mai-2026',
                'description' => 'Atelier pratique d\'une journée pour aider les parents à mieux comprendre et accompagner leur enfant autiste au quotidien.',
                'date'        => now()->addDays(27)->setTime(10, 0),
                'end_date'    => now()->addDays(27)->setTime(16, 0),
                'location'    => 'Cotonou',
                'address'     => 'Cotonou, Bénin',
                'type'        => 'présentiel',
                'status'      => 'upcoming',
                'is_free'     => true,
                'max_participants' => 50,
            ],
            [
                'title'       => 'Journée Mondiale de l\'Autisme 2025',
                'slug'        => 'journee-mondiale-autisme-2025',
                'description' => 'Célébration de la Journée Mondiale de l\'Autisme avec sensibilisation, ateliers créatifs et exposition des œuvres des enfants autistes.',
                'date'        => now()->subMonths(12)->setTime(9, 0),
                'location'    => 'Cotonou, Bénin',
                'type'        => 'présentiel',
                'status'      => 'past',
                'is_free'     => true,
            ],
        ];

        foreach ($events as $e) {
            Event::updateOrCreate(['slug' => $e['slug']], $e);
        }

        // Publications
        $pubs = [
            [
                'title'        => 'Présentation institutionnelle EVA Autisme',
                'slug'         => 'presentation-institutionnelle-evaa',
                'description'  => 'Présentation officielle de l\'ONG EVA Autisme : mission, vision, actions, valeurs et stratégie de développement au Bénin.',
                'category'     => 'presentation',
                'published_at' => now()->subMonths(6),
            ],
            [
                'title'        => 'Types de Partenariats EVA Autisme',
                'slug'         => 'types-partenariats-evaa',
                'description'  => 'Guide complet des formes de collaboration pour les entreprises et institutions souhaitant s\'engager avec l\'ONG.',
                'category'     => 'guide',
                'published_at' => now()->subMonths(8),
            ],
            [
                'title'        => 'Éco Sens et Autisme – Environnement inclusif',
                'slug'         => 'eco-sens-autisme-environnement',
                'description'  => 'Document de projet : sensibilisation des populations béninoises au réchauffement climatique et à l\'autisme.',
                'category'     => 'rapport',
                'published_at' => now()->subMonths(18),
            ],
        ];

        foreach ($pubs as $p) {
            Publication::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // Membres équipe (placeholders)
        $team = [
            ['name' => 'Fondatrice & Présidente', 'role' => 'Direction & Vision stratégique', 'bio' => 'Fondatrice d\'EVA Autisme, elle porte la vision d\'un Bénin inclusif pour tous les enfants autistes depuis la création de l\'ONG en 2022.', 'order' => 1, 'is_active' => true],
            ['name' => 'Coordinatrice des Programmes', 'role' => 'Gestion & Coordination', 'bio' => 'Responsable de la mise en œuvre des programmes de formation, d\'orientation et de soutien aux familles d\'enfants autistes.', 'order' => 2, 'is_active' => true],
            ['name' => 'Responsable Communication', 'role' => 'Communication & Réseaux sociaux', 'bio' => 'En charge de la visibilité de l\'ONG, de la gestion des réseaux sociaux et de la création de contenus de sensibilisation.', 'order' => 3, 'is_active' => true],
        ];

        foreach ($team as $t) {
            TeamMember::updateOrCreate(['name' => $t['name']], $t);
        }

        // Partenaires
        $partners = [
            ['name' => 'MAEJT', 'type' => 'institutionnel', 'order' => 1, 'is_active' => true],
            ['name' => 'Enda JAI', 'type' => 'institutionnel', 'order' => 2, 'is_active' => true],
        ];

        foreach ($partners as $p) {
            Partner::updateOrCreate(['name' => $p['name']], $p);
        }

        $this->command->info('✅ Base de données initialisée avec succès pour EVA Autisme.');
    }
}
