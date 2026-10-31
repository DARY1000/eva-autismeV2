<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category');
            $table->text('summary');
            $table->longText('content')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('location')->nullable();
            $table->string('organizer')->nullable();
            $table->string('theme')->nullable();
            $table->string('cover_image')->nullable();
            $table->json('gallery')->nullable();
            $table->string('video_url')->nullable();
            $table->boolean('is_published')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->index(['is_published', 'start_date']);
        });

        DB::table('activities')->insert([
            'title'       => 'RIACO 2026 : Rencontre Internationale sur l\'Autisme à Cotonou',
            'slug'        => 'riaco-2026',
            'category'    => 'participation',
            'summary'     => 'L\'ONG EVA Autisme a participé à la Rencontre Internationale sur l\'Autisme à Cotonou, du 26 au 30 octobre 2026, sur le thème « Autisme : inclusion sociale, inclusion pédagogique ».',
            'content'     => '<p>Organisée par Autisme Bénin en collaboration avec Autismes Afrique Alliance (AAA), la RIACO 2026 s\'est tenue à Cotonou du 26 au 30 octobre 2026. La cérémonie d\'ouverture a eu lieu le lundi 26 octobre dans la salle de conférence de la Tour administrative B.</p><p>Cette rencontre a réuni des spécialistes venus de France, de Côte d\'Ivoire, du Gabon, du Rwanda, du Sénégal, du Cameroun, du Burkina Faso, de la République du Congo et de la République démocratique du Congo, autour du dépistage, de l\'accompagnement et de la scolarisation des personnes autistes.</p>',
            'start_date'  => '2026-10-26',
            'end_date'    => '2026-10-30',
            'location'    => 'Tour administrative B, Cotonou',
            'organizer'   => 'Autisme Bénin et Autismes Afrique Alliance (AAA)',
            'theme'       => 'Autisme : inclusion sociale, inclusion pédagogique',
            'is_published'=> true,
            'is_featured' => true,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
    public function down(): void { Schema::dropIfExists('activities'); }
};
