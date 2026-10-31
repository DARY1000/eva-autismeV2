<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category');
            $table->text('summary');
            $table->longText('description')->nullable();
            $table->unsignedInteger('price')->nullable();
            $table->unsignedInteger('stock')->nullable(); // vide : pas de limite de stock
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            $table->boolean('is_published')->default(false);
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('prenom');
            $table->string('nom');
            $table->string('email');
            $table->string('telephone');
            $table->string('pays');
            $table->string('ville');
            $table->string('adresse')->nullable();
            $table->string('delivery_mode');
            $table->text('note')->nullable();
            $table->unsignedInteger('total');
            $table->string('status')->default('pending');
            $table->string('fulfillment_status')->default('to_prepare');
            $table->string('payment_method')->nullable();
            $table->string('payment_reference')->nullable()->index();
            $table->string('payment_failure_reason')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->unsignedInteger('unit_price');
            $table->unsignedInteger('quantity');
            $table->timestamps();
        });

        // Brouillons à compléter dans l'admin : ils restent invisibles tant qu'ils n'ont ni prix ni publication.
        $drafts = [
            ['Kit de pictogrammes du quotidien', 'kit-pictogrammes-quotidien', 'communication', 'Des cartes illustrées pour aider l\'enfant à comprendre sa journée et à exprimer ses besoins.'],
            ['Emploi du temps visuel', 'emploi-du-temps-visuel', 'communication', 'Un support à fixer au mur pour annoncer les étapes de la journée et réduire l\'anxiété.'],
            ['Minuteur visuel', 'minuteur-visuel', 'autonomie', 'Le temps qui passe devient visible : un repère simple pour les transitions et les routines.'],
            ['Balles et objets sensoriels', 'balles-objets-sensoriels', 'sensoriel', 'Des objets à manipuler pour s\'apaiser, se concentrer et découvrir de nouvelles textures.'],
            ['Casque anti-bruit enfant', 'casque-anti-bruit-enfant', 'sensoriel', 'Une protection contre les bruits forts dans les lieux animés.'],
            ['Guide pratique pour les parents', 'guide-pratique-parents', 'guides', 'Des conseils concrets pour accompagner son enfant autiste au quotidien.'],
        ];

        foreach ($drafts as $order => [$name, $slug, $category, $summary]) {
            DB::table('products')->insert(compact('name', 'slug', 'category', 'summary', 'order') + [
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }
    }

    public function down(): void {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('products');
    }
};
