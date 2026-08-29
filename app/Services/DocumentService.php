<?php

namespace App\Services;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentService
{
    public function uploadDocument(array $data, int $userId): Document
    {
        $file = $data['file'];
        $path = $file->store('documents', 'public');

        return Document::create([
            'user_id' => $userId,
            'case_id' => $data['case_id'] ?? null,
            'title' => $data['title'],
            'filename' => basename($path),
            'original_filename' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $file->getClientOriginalExtension(),
            'file_size' => $file->getSize(),
            'document_type' => $data['document_type'] ?? 'general',
            'description' => $data['description'] ?? null,
            'is_shared' => $data['is_shared'] ?? false,
            'shared_at' => $data['is_shared'] ? now() : null,
        ]);
    }

    public function shareDocument(Document $document): Document
    {
        $document->update([
            'is_shared' => true,
            'shared_at' => now(),
        ]);
        return $document;
    }

    public function unshareDocument(Document $document): Document
    {
        $document->update([
            'is_shared' => false,
            'shared_at' => null,
        ]);
        return $document;
    }

    public function downloadDocument(Document $document)
    {
        $path = $document->file_path;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($path, $document->original_filename);
    }

    public function getUserDocuments(int $userId): \Illuminate\Database\Eloquent\Collection
    {
        return Document::where('user_id', $userId)
            ->orderByDesc('created_at')
            ->get();
    }
}