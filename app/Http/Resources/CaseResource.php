<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CaseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'case_number' => $this->case_number,
            'title' => $this->title,
            'client' => $this->whenLoaded('client', fn () => [
                'id' => $this->client->id,
                'name' => $this->client->full_name,
                'email' => $this->client->email,
            ]),
            'practice_area' => $this->whenLoaded('practiceArea', fn () => [
                'id' => $this->practiceArea->id,
                'title' => $this->practiceArea->title,
            ]),
            'opponent_name' => $this->opponent_name,
            'court_name' => $this->court_name,
            'status' => $this->status,
            'priority' => $this->priority,
            'fees' => $this->fees,
            'filed_date' => $this->filed_date?->format('Y-m-d'),
            'next_hearing_date' => $this->next_hearing_date?->format('Y-m-d'),
            'description' => $this->description,
            'documents_count' => $this->whenCounted('documents'),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}