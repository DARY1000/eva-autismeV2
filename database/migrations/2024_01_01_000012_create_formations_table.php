<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('public_cible');    // Parents, Enseignants, Professionnels, Entreprises…
            $table->text('description');
            $table->text('objectifs')->nullable();
            $table->string('duree')->nullable();  // ex: "1 journée", "2 demi-journées"
            $table->string('format')->nullable();  // Présentiel / En ligne / Hybride
            $table->string('lieu')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->string('icon_color')->default('primary'); // primary | accent | green | teal
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
