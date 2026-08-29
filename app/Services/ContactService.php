<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\ConsultationRequest;
use Illuminate\Support\Facades\Mail;

class ContactService
{
    public function storeContact(array $data): Contact
    {
        return Contact::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'subject' => $data['subject'],
            'message' => $data['message'],
            'status' => 'new',
        ]);
    }

    public function storeConsultationRequest(array $data): ConsultationRequest
    {
        return ConsultationRequest::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'practice_area_id' => $data['practice_area_id'] ?? null,
            'preferred_contact' => $data['preferred_contact'] ?? 'email',
            'message' => $data['message'],
            'preferred_date' => $data['preferred_date'] ?? null,
            'preferred_time' => $data['preferred_time'] ?? null,
            'status' => 'new',
        ]);
    }

    public function replyToContact(Contact $contact, string $reply): void
    {
        $contact->update([
            'admin_reply' => $reply,
            'status' => 'replied',
            'replied_at' => now(),
        ]);
    }
}