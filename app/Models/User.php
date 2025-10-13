<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'email_verified_at',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'author_id');
    }
    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'created_by');
    }
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'created_by');
    }
    public function careers(): HasMany
    {
        return $this->hasMany(Career::class, 'created_by');
    }
    public function partners(): HasMany
    {
        return $this->hasMany(Partner::class, 'created_by');
    }
    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }
    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }
    public function contactMessages(): HasMany
    {
        return $this->hasMany(ContactMessage::class, 'user_id');
    }
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
        // return str_ends_with($this->email, '@fokusinovasidigital.com') && $this->role === 'admin';
    }
}
