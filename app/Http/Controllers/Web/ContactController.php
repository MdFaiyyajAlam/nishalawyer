<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactRequest;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        return view('public.contact');
    }

    public function store(ContactRequest $request)
    {
        $contact = $this->contactService->storeContact($request->validated());

        return back()->with('success', 'Thank you for your message! We will get back to you within 24 hours.');
    }
}