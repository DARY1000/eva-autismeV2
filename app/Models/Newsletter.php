<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'is_active',
        'confirmed_at',
        'token',
    ];

    protected function casts(): array
    {
        return [
            'is_active'    => 'boolean',
            'confirmed_at' => 'datetime',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Newsletter $newsletter) {
            if (empty($newsletter->token)) {
                $newsletter->token = Str::random(64);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function confirm(): void
    {
        $this->update([
            'is_active'    => true,
            'confirmed_at' => now(),
        ]);
    }
}
