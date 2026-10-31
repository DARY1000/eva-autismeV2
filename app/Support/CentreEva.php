<?php

namespace App\Support;

/** Contenu de la page du projet de centre, partagé entre le texte et la maquette 3D. */
class CentreEva
{
    /** Les clés correspondent aux bâtiments construits dans public/js/centre-3d.js. */
    public const ZONES = [
        'accueil' => [
            'title' => 'Accueil et évaluation',
            'text'  => 'Un sas calme pour arriver à son rythme. Les familles y sont écoutées, orientées vers le dépistage et accompagnées dans leurs démarches.',
        ],
        'classes' => [
            'title' => 'Classes d\'éducation structurée',
            'text'  => 'De petits groupes, des pictogrammes et des emplois du temps visuels, avec un objectif : préparer chaque enfant à rejoindre l\'école ordinaire lorsque c\'est possible.',
        ],
        'therapies' => [
            'title' => 'Pôle thérapies',
            'text'  => 'Des salles individuelles pour l\'orthophonie, la psychomotricité et l\'ergothérapie, proches les unes des autres pour limiter les déplacements.',
        ],
        'sensoriel' => [
            'title' => 'Salle sensorielle',
            'text'  => 'Lumière douce, sons choisis et textures variées pour s\'apaiser ou stimuler les sens, à l\'écart des espaces bruyants.',
        ],
        'ateliers' => [
            'title' => 'Ateliers d\'autonomie et métiers',
            'text'  => 'Cuisine, entretien, artisanat et jardinage pour apprendre les gestes du quotidien et préparer les adolescents et les adultes à une activité.',
        ],
        'formation' => [
            'title' => 'Centre de formation',
            'text'  => 'Un lieu pour former les enseignants, les professionnels de santé, les travailleurs sociaux et les parents à l\'accompagnement de l\'autisme.',
        ],
        'familles' => [
            'title' => 'Maison des familles',
            'text'  => 'Une paillote ouverte sur le jardin pour le Club Parents, l\'entraide entre familles et des temps de répit.',
        ],
        'jardin' => [
            'title' => 'Jardin sensoriel',
            'text'  => 'Des chemins aux textures différentes, de l\'ombre, de l\'eau et un potager, dans l\'esprit de notre projet Éco Sens. Le patio est entièrement clos pour la sécurité des enfants.',
        ],
        'logement' => [
            'title' => 'Logement adapté',
            'text'  => 'De petites maisons à taille humaine pour les personnes en situation de handicap mental qui ont besoin d\'un accompagnement au quotidien.',
        ],
    ];

    /** Principes d'architecture adaptée à l'autisme (index ASPECTSS de Magda Mostafa). */
    public const DESIGN_PRINCIPLES = [
        ['title' => 'Acoustique maîtrisée', 'text' => 'Des murs épais, des claustras et des matériaux qui réduisent l\'écho et les bruits soudains.'],
        ['title' => 'Parcours prévisible', 'text' => 'Une circulation simple, en boucle autour du patio, pour toujours savoir où l\'on va.'],
        ['title' => 'Espaces de retrait', 'text' => 'De petits refuges calmes, accessibles à tout moment en cas de surcharge.'],
        ['title' => 'Espaces bien délimités', 'text' => 'Chaque activité a son lieu, repérable par sa couleur et ses pictogrammes.'],
        ['title' => 'Zones de transition', 'text' => 'Des galeries ombragées pour passer en douceur d\'une activité à l\'autre.'],
        ['title' => 'Zonage sensoriel', 'text' => 'Les espaces calmes sont séparés des espaces plus animés.'],
        ['title' => 'Sécurité', 'text' => 'Un site clos, des matériaux sans danger et des accès surveillés.'],
    ];

    /** Rapprochement entre les orientations publiques et ce que le centre peut apporter. */
    public const ALIGNMENT = [
        [
            'source' => 'Projet de société 2026-2033 · Éducation',
            'public' => 'Accompagner chaque Béninois de la maternelle au premier emploi, avec des passerelles pour les enfants déscolarisés et une formation continue des enseignants.',
            'centre' => 'Des classes passerelles vers l\'école ordinaire et des formations à l\'autisme pour les enseignants.',
        ],
        [
            'source' => 'Projet de société 2026-2033 · Protection sociale',
            'public' => 'Un programme national pour mieux intégrer les personnes en situation de handicap : formation, insertion et matériel adapté.',
            'centre' => 'Des ateliers d\'autonomie et de métiers, des outils adaptés et un accompagnement vers l\'insertion.',
        ],
        [
            'source' => 'Projet de société 2026-2033 · Vulnérabilité',
            'public' => 'Le renforcement des structures d\'accueil des populations en situation de grande vulnérabilité.',
            'centre' => 'Un accueil de jour, des temps de répit et un logement adapté.',
        ],
        [
            'source' => 'Vision Bénin 2060 Alafia',
            'public' => 'Un Bénin de paix, de bonne gouvernance, de prospérité et de rayonnement, mis en œuvre à partir du Plan national de développement 2026-2035.',
            'centre' => 'Une participation concrète au bien-être commun : aucune famille laissée seule face à l\'autisme.',
        ],
    ];

    public const SOURCES = [
        ['label' => 'Programme 2026-2033 de Romuald Wadagni : éducation', 'url' => 'https://wadagni.bj/projet/programme/education'],
        ['label' => 'Programme 2026-2033 de Romuald Wadagni : protection sociale', 'url' => 'https://wadagni.bj/projet/programme/protection-sociale'],
        ['label' => 'Vision Bénin 2060 Alafia', 'url' => 'https://visionbenin2060.gouv.bj/'],
        ['label' => 'Gouvernement du Bénin : prise en charge intégrée des enfants autistes', 'url' => 'https://www.gouv.bj/article/2671/prise-charge-integree-enfants-autistes-benin-phase-pilote-lancee-communes-cotonou-abomey-calavi/'],
        ['label' => 'OMS : aide-mémoire sur l\'autisme', 'url' => 'https://www.who.int/fr/news-room/fact-sheets/detail/autism-spectrum-disorders'],
    ];
}
