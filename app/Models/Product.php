<?php

namespace App\Models;

use App\Services\FeexPay;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public const CATEGORIES = [
        'sensoriel'     => 'Produits sensoriels',
        'communication' => 'Pictogrammes & communication',
        'autonomie'     => 'Autonomie & routines',
        'guides'        => 'Guides',
    ];

    protected $fillable = [
        'name', 'slug', 'category', 'summary', 'description', 'price', 'stock',
        'image', 'gallery', 'is_published', 'order',
    ];

    protected function casts(): array
    {
        return [
            'gallery'      => 'array',
            'is_published' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->where('price', '>=', FeexPay::MIN_AMOUNT);
    }

    public function getIsAvailableAttribute(): bool
    {
        return $this->stock === null || $this->stock > 0;
    }

    public function getPriceLabelAttribute(): string
    {
        return number_format((int) $this->price, 0, ',', ' ').' F CFA';
    }
}
