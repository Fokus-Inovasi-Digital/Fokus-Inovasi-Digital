<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'career_id',
        'user_id',
        'full_name',
        'email',
        'phone',
        'address',
        'cv_file',
        'cover_letter_file',
        'portfolio_file',
        'additional_notes',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];
    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
