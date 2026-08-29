<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\PracticeArea;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::with('practiceArea');

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $faqs = $query->orderBy('sort_order')->paginate(15);

        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $practiceAreas = PracticeArea::where('is_active', true)->get();
        return view('admin.faqs.create', compact('practiceAreas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'practice_area_id' => ['nullable', 'exists:practice_areas,id'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        Faq::create($validated);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ created successfully!');
    }

    public function edit(Faq $faq)
    {
        $practiceAreas = PracticeArea::where('is_active', true)->get();
        return view('admin.faqs.edit', compact('faq', 'practiceAreas'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'practice_area_id' => ['nullable', 'exists:practice_areas,id'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ updated successfully!');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return back()->with('success', 'FAQ deleted!');
    }
}