<?php
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Le mot de passe initial des comptes a été publié dans le dépôt : tout compte
 * qui l'utilise encore reçoit un mot de passe aléatoire. Pour le réinitialiser :
 * php artisan admin:reset-password <email>
 */
return new class extends Migration {
    public function up(): void {
        User::query()->each(function (User $user) {
            if (Hash::check('EvaAutisme2024!', $user->password)) {
                $user->forceFill(['password' => Str::password(32), 'remember_token' => null])->save();
            }
        });
    }
    public function down(): void {}
};
