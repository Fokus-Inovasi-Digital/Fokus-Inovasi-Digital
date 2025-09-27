<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'status',
        'published_at',
        'author_id',
        'updated_by',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'status' => 'string',
    ];
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function scopePublished($query)
    {
        return $query->where('status', 'published')->whereNotNull('published_at')->orderBy('published_at', 'desc');
    }
}
