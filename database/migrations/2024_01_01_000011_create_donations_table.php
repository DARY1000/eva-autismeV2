<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('telephone');
            $table->string('pays')->default('Bénin');
            $table->decimal('montant', 12, 2);
            $table->string('frequence')->default('ponctuel');
            $table->text('message')->nullable();
            $table->string('status')->default('pending');
            $table->string('reference')->nullable()->unique();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('donations'); }
};
