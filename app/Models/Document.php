<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'case_id',
        'title',
        'filename',
        'original_filename',
        'file_path',
        'file_type',
        'file_size',
        'document_type',
        'description',
        'is_shared',
        'shared_at',
    ];

    protected $casts = [
        'is_shared' => 'boolean',
        'shared_at' => 'datetime',
        'file_size' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function legalCase(): BelongsTo
    {
        return $this->belongsTo(LegalCase::class, 'case_id');
    }

    public function getFileSizeFormattedAttribute(): string
    {
        $bytes = $this->file_size;
        if ($bytes >= 1073741824) return round($bytes / 1073741824, 2) . ' GB';
        if ($bytes >= 1048576) return round($bytes / 1048576, 2) . ' MB';
        if ($bytes >= 1024) return round($bytes / 1024, 2) . ' KB';
        return $bytes . ' B';
    }

    public function getIconClassAttribute(): string
    {
        return match (strtolower($this->file_type)) {
            'pdf' => 'bi-file-pdf',
            'doc', 'docx' => 'bi-file-word',
            'xls', 'xlsx' => 'bi-file-excel',
            'jpg', 'jpeg', 'png', 'gif' => 'bi-file-image',
            'txt' => 'bi-file-text',
            default => 'bi-file-earmark',
        };
    }
}