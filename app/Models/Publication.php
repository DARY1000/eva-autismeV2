<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'file_path',
        'file_url',
        'cover_image',
        'published_at',
        'is_featured',
        'download_count',
    ];

    protected function casts(): array
    {
        return [
            'published_at'   => 'date',
            'is_featured'    => 'boolean',
            'download_count' => 'integer',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Publication $publication) {
            if (empty($publication->slug)) {
                $publication->slug = Str::slug($publication->title);
            }
        });

        static::updating(function (Publication $publication) {
            if ($publication->isDirty('title') && empty($publication->slug)) {
                $publication->slug = Str::slug($publication->title);
            }
        });
    }

    public function incrementDownload(): void
    {
        $this->increment('download_count');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }
}
