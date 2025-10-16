<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'status',
        'work_type',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'status' => 'string',
        'work_type' => 'string',
    ];
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
