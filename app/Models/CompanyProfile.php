<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'hero_subheading',
        'about_subheading',
        'description',
        'address',
        'phone',
        'email',
        'vision',
        'mission',
        'quote',
        'logo',
        'social_media',
        'website_url',
    ];

    protected $casts = [
        'social_media' => 'array',
    ];
}
