<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Activity extends Model
{
    use HasFactory;

    public const CATEGORIES = [
        'participation'   => 'Participation à un événement',
        'sensibilisation' => 'Sensibilisation',
        'formation'       => 'Formation',
        'plaidoyer'       => 'Plaidoyer',
        'familles'        => 'Accompagnement des familles',
        'journee'         => 'Journée mondiale',
        'solidarite'      => 'Solidarité & collecte',
        'autre'           => 'Autre',
    ];

    protected $fillable = [
        'title',
        'slug',
        'category',
        'summary',
        'content',
        'start_date',
        'end_date',
        'location',
        'organizer',
        'theme',
        'cover_image',
        'gallery',
        'video_url',
        'is_published',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'start_date'   => 'date',
            'end_date'     => 'date',
            'gallery'      => 'array',
            'is_published' => 'boolean',
            'is_featured'  => 'boolean',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Activity $activity) {
            if (empty($activity->slug)) {
                $activity->slug = Str::slug($activity->title);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /** Années ayant au moins une activité, de la plus récente à la plus ancienne. */
    public static function years(bool $publishedOnly = false)
    {
        return self::query()
            ->when($publishedOnly, fn ($query) => $query->published())
            ->pluck('start_date')
            ->map(fn ($date) => $date->year)
            ->unique()
            ->sortDesc()
            ->values();
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderByDesc('start_date');
    }

    public function getYearAttribute(): int
    {
        return $this->start_date->year;
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? $this->category;
    }

    public function getCoverAttribute(): ?string
    {
        return $this->cover_image ?: ($this->gallery[0] ?? null);
    }

    public function getPeriodLabelAttribute(): string
    {
        $start = $this->start_date->locale('fr');

        if (! $this->end_date || $this->end_date->eq($this->start_date)) {
            return $start->isoFormat('D MMMM YYYY');
        }

        $end = $this->end_date->locale('fr');

        return $start->isSameMonth($end)
            ? $start->isoFormat('D').' au '.$end->isoFormat('D MMMM YYYY')
            : $start->isoFormat('D MMMM').' au '.$end->isoFormat('D MMMM YYYY');
    }
}
