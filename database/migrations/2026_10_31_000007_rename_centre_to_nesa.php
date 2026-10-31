<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        DB::table('projects')->where('slug', 'centre-eva-autisme')->update([
            'title' => 'Centre NESA',
            'slug'  => 'centre-nesa',
            'link'  => '/nos-actions/le-centre-nesa',
        ]);
    }

    public function down(): void {
        DB::table('projects')->where('slug', 'centre-nesa')->update([
            'title' => 'Centre EVA Autisme',
            'slug'  => 'centre-eva-autisme',
            'link'  => '/nos-actions/le-centre-eva',
        ]);
    }
};
