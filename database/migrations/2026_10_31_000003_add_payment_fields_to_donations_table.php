<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('donations', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('status');
            $table->string('payment_reference')->nullable()->unique()->after('payment_method');
            $table->string('payment_failure_reason')->nullable()->after('payment_reference');
            $table->timestamp('paid_at')->nullable()->after('payment_failure_reason');
        });
    }
    public function down(): void {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropUnique(['payment_reference']);
            $table->dropColumn(['payment_method', 'payment_reference', 'payment_failure_reason', 'paid_at']);
        });
    }
};
