<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('link')->nullable()->after('image');
        });

        // La page lisait des champs qui n'existent pas : ces projets n'étaient jamais affichés.
        $projects = [
            ['Centre EVA Autisme', 'centre-eva-autisme', 'Accompagnement', 'upcoming', '/nos-actions/le-centre-eva', 'Un centre de jour et de logement adapté au Bénin, pour réunir en un seul lieu l\'éducation, les thérapies, la formation et le soutien aux familles. Découvrez-le en 3D.'],
            ['Éco Sens', 'eco-sens', 'Sensibilisation', 'active', null, 'Un projet innovant qui associe la sensibilisation à l\'autisme à l\'éducation environnementale. Des ateliers ludiques permettent aux enfants autistes de s\'épanouir dans la nature tout en sensibilisant les communautés aux TSA.'],
            ['Club Parents EVA', 'club-parents-eva', 'Soutien familial', 'active', '/nos-actions/club-parents', 'Un espace d\'échange, de formation et de soutien mutuel pour les parents d\'enfants autistes. Des rencontres mensuelles, des ateliers pratiques et un accompagnement personnalisé pour chaque famille.'],
            ['Programme Scolarisation Inclusive', 'programme-scolarisation-inclusive', 'Éducation', 'active', null, 'Un programme de plaidoyer et d\'accompagnement pour faciliter l\'accès des enfants autistes à l\'école ordinaire. Formation des enseignants, aménagements pédagogiques et suivi individualisé.'],
            ['Campagne Sensibilisation TSA', 'campagne-sensibilisation-tsa', 'Sensibilisation', 'completed', null, 'Des campagnes annuelles dans les médias, les écoles et les espaces publics pour diffuser une information juste et accessible sur les Troubles du Spectre de l\'Autisme au sein de la population béninoise.'],
            ['Programme Formation Professionnels', 'programme-formation-professionnels', 'Formation', 'completed', '/nos-actions/formation', 'Renforcement des capacités des professionnels de santé, des enseignants et des travailleurs sociaux pour un meilleur dépistage précoce et une prise en charge adaptée des personnes autistes.'],
            ['Projet Accompagnement à Domicile', 'projet-accompagnement-a-domicile', 'Accompagnement', 'active', null, 'Un dispositif de visites à domicile pour soutenir les familles isolées. Des éducateurs spécialisés se déplacent pour former les parents et proposer des stratégies d\'intervention adaptées au contexte familial.'],
        ];

        foreach ($projects as $order => [$title, $slug, $category, $status, $link, $description]) {
            if (DB::table('projects')->where('slug', $slug)->doesntExist()) {
                DB::table('projects')->insert(compact('title', 'slug', 'category', 'status', 'link', 'description', 'order') + [
                    'created_at' => now(), 'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('link');
        });
    }
};
