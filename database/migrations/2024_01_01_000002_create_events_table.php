<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->dateTime('date');
            $table->dateTime('end_date')->nullable();
            $table->string('location')->nullable();
            $table->text('address')->nullable();
            $table->enum('type', ['présentiel', 'en ligne', 'hybride'])->default('présentiel');
            $table->enum('status', ['upcoming', 'past', 'cancelled'])->default('upcoming');
            $table->string('image')->nullable();
            $table->unsignedInteger('max_participants')->nullable();
            $table->boolean('is_free')->default(true);
            $table->decimal('price', 10, 2)->nullable();
            $table->dateTime('registration_deadline')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
