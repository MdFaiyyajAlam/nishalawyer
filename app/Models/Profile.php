<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'bio',
        'bar_council_number',
        'specialization',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'website',
        'linkedin',
        'twitter',
        'facebook',
        'qualifications',
        'bar_registrations',
        'profile_image',
    ];

    protected $casts = [
        'qualifications' => 'array',
        'bar_registrations' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getProfileImageUrlAttribute(): ?string
    {
        if ($this->profile_image && \Storage::disk('public')->exists($this->profile_image)) {
            return \Storage::url($this->profile_image);
        }
        return null;
    }
}