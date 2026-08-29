<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LegalCase extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cases';

    protected $fillable = [
        'case_number',
        'title',
        'client_id',
        'advocate_id',
        'practice_area_id',
        'opponent_name',
        'opponent_details',
        'court_name',
        'court_case_number',
        'status',
        'priority',
        'description',
        'fees',
        'filed_date',
        'next_hearing_date',
        'remarks',
        'is_active',
    ];

    protected $casts = [
        'filed_date' => 'date',
        'next_hearing_date' => 'date',
        'is_active' => 'boolean',
        'fees' => 'decimal:2',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function advocate(): BelongsTo
    {
        return $this->belongsTo(User::class, 'advocate_id');
    }

    public function practiceArea(): BelongsTo
    {
        return $this->belongsTo(PracticeArea::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(CaseDocument::class, 'case_id');
    }

    public function legalNotices(): HasMany
    {
        return $this->hasMany(LegalNotice::class, 'case_id');
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'active' => 'bg-green-100 text-green-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'dismissed' => 'bg-red-100 text-red-800',
            'settled' => 'bg-blue-100 text-blue-800',
            'closed' => 'bg-gray-100 text-gray-800',
            'won' => 'bg-emerald-100 text-emerald-800',
            'lost' => 'bg-rose-100 text-rose-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getPriorityBadgeClassAttribute(): string
    {
        return match ($this->priority) {
            'low' => 'bg-gray-100 text-gray-600',
            'medium' => 'bg-blue-100 text-blue-800',
            'high' => 'bg-orange-100 text-orange-800',
            'urgent' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-600',
        };
    }
}