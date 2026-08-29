<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'filename' => $this->filename,
            'original_filename' => $this->original_filename,
            'file_type' => $this->file_type,
            'file_size' => $this->file_size,
            'file_size_formatted' => $this->file_size_formatted,
            'document_type' => $this->document_type,
            'description' => $this->description,
            'is_shared' => $this->is_shared,
            'shared_at' => $this->shared_at?->format('Y-m-d H:i:s'),
            'download_url' => $this->when($this->is_shared, route('client.documents.download', $this->id)),
            'user' => $this->whenLoaded('user', fn () => [
                'id' => $this->user->id,
                'name' => $this->user->full_name,
            ]),
            'case' => $this->whenLoaded('legalCase', fn () => [
                'id' => $this->legalCase->id,
                'case_number' => $this->legalCase->case_number,
            ]),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}