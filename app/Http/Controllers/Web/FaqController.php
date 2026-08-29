<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ConsultationRequest;
use App\Models\Faq;
use App\Models\PracticeArea;
use App\Services\ContactService;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    protected ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        $faqs = Faq::where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        $practiceAreas = PracticeArea::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->get();

        return view('public.faq', compact('faqs', 'practiceAreas'));
    }

    public function consultationStore(ConsultationRequest $request)
    {
        $this->contactService->storeConsultationRequest($request->validated());

        return back()->with('success', 'Your consultation request has been submitted successfully! We will contact you within 24 hours.');
    }
}