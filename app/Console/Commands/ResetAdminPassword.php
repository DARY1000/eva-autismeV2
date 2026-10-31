<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetAdminPassword extends Command
{
    protected $signature = 'admin:reset-password {email}';

    protected $description = 'Change le mot de passe d\'un compte admin (saisie masquée, rien dans l\'historique)';

    public function handle(): int
    {
        $user = User::where('email', $this->argument('email'))->first();

        if (! $user) {
            $this->error('Aucun compte avec cet email.');

            return self::FAILURE;
        }

        $password = (string) $this->secret('Nouveau mot de passe (12 caractères minimum)');

        if (mb_strlen($password) < 12) {
            $this->error('Mot de passe trop court.');

            return self::FAILURE;
        }

        $user->forceFill(['password' => $password, 'remember_token' => null])->save();
        $this->info('Mot de passe modifié.');

        return self::SUCCESS;
    }
}
