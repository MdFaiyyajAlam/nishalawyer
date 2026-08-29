<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ConsultationRequest;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function contacts(Request $request)
    {
        $query = Contact::with('appointment');

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $contacts = $query->orderByDesc('created_at')->paginate(15);

        return view('admin.contacts.index', compact('contacts'));
    }

    public function showContact(Contact $contact)
    {
        $contact->load('appointment');
        $contact->update(['status' => 'read']);

        return view('admin.contacts.show', compact('contact'));
    }

    public function replyContact(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'admin_reply' => ['required', 'string'],
        ]);

        $this->contactService->replyToContact($contact, $validated['admin_reply']);

        return back()->with('success', 'Reply sent successfully!');
    }

    public function destroyContact(Contact $contact)
    {
        $contact->delete();

        return back()->with('success', 'Contact message deleted!');
    }

    public function consultationRequests(Request $request)
    {
        $query = ConsultationRequest::with('practiceArea');

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $requests = $query->orderByDesc('created_at')->paginate(15);

        return view('admin.consultation-requests.index', compact('requests'));
    }

    public function showConsultation(ConsultationRequest $request)
    {
        $request->load('practiceArea');
        $request->update(['status' => 'in_progress']);

        return view('admin.consultation-requests.show', compact('request'));
    }

    public function updateConsultation(Request $request, ConsultationRequest $consultationRequest)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,in_progress,scheduled,closed,cancelled'],
            'admin_notes' => ['nullable', 'string'],
            'handled_at' => ['nullable', 'date'],
        ]);

        $consultationRequest->update($validated);

        return back()->with('success', 'Consultation request updated!');
    }
}