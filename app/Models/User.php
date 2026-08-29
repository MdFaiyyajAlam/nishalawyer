<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'avatar',
        'role_id',
        'is_active',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // --- Relationships ---

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointments', 'client_id', 'id');
    }

    public function cases()
    {
        return $this->hasMany(LegalCase::class, 'client_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    // --- Accessors ---

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getAvatarUrlAttribute(): ?string
    {
        if ($this->avatar && Storage::disk('public')->exists($this->avatar)) {
            return Storage::url($this->avatar);
        }
        return null;
    }

    // --- Helper Methods ---

    public function hasRole(string $role): bool
    {
        return $this->role?->slug === $role;
    }

    public function hasAnyRole(string|array $roles): bool
    {
        $roles = is_array($roles) ? $roles : [$roles];
        return in_array($this->role?->name, $roles);
    }

    public function hasPermission(string $permission): bool
    {
        return $this->role?->permissions->contains('slug', $permission) ?? false;
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isAdvocate(): bool
    {
        return $this->hasRole('advocate');
    }

    public function isClient(): bool
    {
        return $this->hasRole('client');
    }
}
