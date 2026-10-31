<?php

namespace App\Models;

use App\Support\SpamGuard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'organization',
        'subject',
        'message',
        'status',
        'spam_reason',
        'ip_address',
    ];

    protected function casts(): array
    {
        return [];
    }

    public function scopeReal($query)
    {
        return $query->where('status', '!=', 'spam');
    }

    /** Classe en spam les messages non traités qui correspondent aux règles. */
    public static function flagExistingSpam(): int
    {
        $flagged = 0;

        self::whereIn('status', ['new', 'read'])->each(function (Contact $contact) use (&$flagged) {
            $result = SpamGuard::inspect($contact->name, $contact->organization, $contact->message);

            if ($result['score'] >= SpamGuard::THRESHOLD) {
                $contact->update(['status' => 'spam', 'spam_reason' => implode(', ', $result['reasons'])]);
                $flagged++;
            }
        });

        return $flagged;
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeUnread($query)
    {
        return $query->whereIn('status', ['new', 'read']);
    }

    public function markAsRead(): void
    {
        $this->update(['status' => 'read']);
    }

    public function markAsReplied(): void
    {
        $this->update(['status' => 'replied']);
    }
}
