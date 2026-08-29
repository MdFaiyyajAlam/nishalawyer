<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PracticeAreaRequest;
use App\Models\PracticeArea;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PracticeAreaController extends Controller
{
    public function index()
    {
        $practiceAreas = PracticeArea::orderBy('sort_order')->get();
        return view('admin.practice-areas.index', compact('practiceAreas'));
    }

    public function create()
    {
        return view('admin.practice-areas.create');
    }

    public function store(PracticeAreaRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('practice-areas', 'public');
        }

        PracticeArea::create($data);

        return redirect()->route('admin.practice-areas.index')
            ->with('success', 'Practice area created successfully!');
    }

    public function show(PracticeArea $practiceArea)
    {
        return view('admin.practice-areas.show', compact('practiceArea'));
    }

    public function edit(PracticeArea $practiceArea)
    {
        return view('admin.practice-areas.edit', compact('practiceArea'));
    }

    public function update(PracticeAreaRequest $request, PracticeArea $practiceArea)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($practiceArea->image) {
                \Storage::disk('public')->delete($practiceArea->image);
            }
            $data['image'] = $request->file('image')->store('practice-areas', 'public');
        }

        $practiceArea->update($data);

        return redirect()->route('admin.practice-areas.index')
            ->with('success', 'Practice area updated successfully!');
    }

    public function destroy(PracticeArea $practiceArea)
    {
        if ($practiceArea->image) {
            \Storage::disk('public')->delete($practiceArea->image);
        }

        $practiceArea->delete();

        return back()->with('success', 'Practice area deleted!');
    }
}