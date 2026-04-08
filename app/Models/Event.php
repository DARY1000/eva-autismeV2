<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'date',
        'end_date',
        'location',
        'address',
        'type',
        'status',
        'image',
        'max_participants',
        'is_free',
        'price',
        'registration_deadline',
    ];

    protected function casts(): array
    {
        return [
            'date'                  => 'datetime',
            'end_date'              => 'datetime',
            'registration_deadline' => 'datetime',
            'is_free'               => 'boolean',
            'price'                 => 'decimal:2',
            'max_participants'      => 'integer',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Event $event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });

        static::updating(function (Event $event) {
            if ($event->isDirty('title') && empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function getIsUpcomingAttribute(): bool
    {
        return $this->date && $this->date->isFuture();
    }

    public function getIsPastAttribute(): bool
    {
        return $this->date && $this->date->isPast();
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming')
                     ->where('date', '>=', Carbon::now())
                     ->orderBy('date');
    }

    public function scopePast($query)
    {
        return $query->where('status', 'past')
                     ->orWhere('date', '<', Carbon::now())
                     ->orderBy('date', 'desc');
    }
}
