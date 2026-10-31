<?php

namespace App\Console\Commands;

use App\Models\Contact;
use Illuminate\Console\Command;

class FlagSpamContacts extends Command
{
    protected $signature = 'contacts:flag-spam';

    protected $description = 'Classe en spam les messages déjà reçus qui correspondent aux règles anti-spam';

    public function handle(): int
    {
        $this->info(Contact::flagExistingSpam().' message(s) classé(s) en spam.');

        return self::SUCCESS;
    }
}
