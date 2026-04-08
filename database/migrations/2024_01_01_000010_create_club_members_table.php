<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('club_members', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('telephone');
            $table->string('ville');
            $table->text('situation_enfant')->nullable();
            $table->string('comment_nous_connu')->nullable();
            $table->string('status')->default('pending');
            $table->timestamp('joined_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('club_members'); }
};
