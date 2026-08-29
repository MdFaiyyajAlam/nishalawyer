<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PracticeArea;
use Illuminate\Http\Request;

class PracticeAreaController extends Controller
{
    public function index()
    {
        $practiceAreas = PracticeArea::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('public.practice-areas', compact('practiceAreas'));
    }

    public function show(string $slug)
    {
        $practiceArea = PracticeArea::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $faqs = $practiceArea->faqs()
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        return view('public.practice-area-detail', compact('practiceArea', 'faqs'));
    }
}