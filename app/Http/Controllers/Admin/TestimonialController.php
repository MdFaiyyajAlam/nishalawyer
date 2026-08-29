<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimonial::with(['user', 'practiceArea']);

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $testimonials = $query->orderByDesc('created_at')->paginate(15);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        $practiceAreas = \App\Models\PracticeArea::where('is_active', true)->get();
        return view('admin.testimonials.create', compact('practiceAreas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => ['required', 'string', 'max:100'],
            'client_title' => ['nullable', 'string', 'max:100'],
            'content' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'practice_area_id' => ['nullable', 'exists:practice_areas,id'],
            'is_featured' => ['boolean'],
        ]);

        $validated['status'] = 'approved';
        $validated['approved_at'] = now();

        if ($request->hasFile('client_avatar')) {
            $validated['client_avatar'] = $request->file('client_avatar')->store('testimonials', 'public');
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully!');
    }

    public function show(Testimonial $testimonial)
    {
        $testimonial->load(['user', 'practiceArea']);
        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function edit(Testimonial $testimonial)
    {
        $practiceAreas = \App\Models\PracticeArea::where('is_active', true)->get();
        return view('admin.testimonials.edit', compact('testimonial', 'practiceAreas'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'client_name' => ['required', 'string', 'max:100'],
            'client_title' => ['nullable', 'string', 'max:100'],
            'content' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'practice_area_id' => ['nullable', 'exists:practice_areas,id'],
            'is_featured' => ['boolean'],
            'status' => ['required', 'in:pending,approved,rejected'],
        ]);

        if ($request->hasFile('client_avatar')) {
            if ($testimonial->client_avatar) {
                \Storage::disk('public')->delete($testimonial->client_avatar);
            }
            $validated['client_avatar'] = $request->file('client_avatar')->store('testimonials', 'public');
        }

        if ($validated['status'] === 'approved' && ! $testimonial->approved_at) {
            $validated['approved_at'] = now();
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully!');
    }

    public function approve(Testimonial $testimonial)
    {
        $testimonial->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Testimonial approved!');
    }

    public function reject(Testimonial $testimonial)
    {
        $testimonial->update(['status' => 'rejected']);

        return back()->with('success', 'Testimonial rejected!');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->client_avatar) {
            \Storage::disk('public')->delete($testimonial->client_avatar);
        }

        $testimonial->delete();

        return back()->with('success', 'Testimonial deleted!');
    }
}