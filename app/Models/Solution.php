<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Solution extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'content',
        'category',
        'status',
        'published_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Code to convert the category URL slug into its plural form (e.g., solutions/services, solutions/products)
    public const CATEGORY_SERVICE = 'service';
    public const CATEGORY_INFRASTRUCTURE = 'infrastructure';
    public const CATEGORY_PRODUCT = 'product';

    public const CATEGORIES = [
        self::CATEGORY_SERVICE,
        self::CATEGORY_INFRASTRUCTURE,
        self::CATEGORY_PRODUCT,
    ];

    public static $categorySlugMap = [
        'services' => self::CATEGORY_SERVICE,
        'infrastructures' => self::CATEGORY_INFRASTRUCTURE,
        'products' => self::CATEGORY_PRODUCT,
    ];

    public static function getCategorySlug(string $singularValue): string
    {
        $reverseMap = array_flip(self::$categorySlugMap);

        return $reverseMap[$singularValue] ?? $singularValue;
    }

    public function getCategorySlugAttribute(): string
    {
        return self::getCategorySlug($this->category);
    }
}
