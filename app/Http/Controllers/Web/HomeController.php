<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PracticeArea;
use App\Models\BlogPost;
use App\Models\Testimonial;
use App\Services\BlogService;
use App\Services\ContactService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected BlogService $blogService;
    protected ContactService $contactService;

    public function __construct(BlogService $blogService, ContactService $contactService)
    {
        $this->blogService = $blogService;
        $this->contactService = $contactService;
    }

    public function index()
    {
        $practiceAreas = PracticeArea::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $featuredPracticeAreas = $practiceAreas
            ->where('is_featured', true)
            ->take(6)
            ->values();

        $featuredTestimonials = Testimonial::where('status', 'approved')
            ->where('is_featured', true)
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        $featuredPosts = $this->blogService->getFeaturedPosts(3);
        $recentPosts = $this->blogService->getRecentPosts(3);

        $stats = [
            'years_experience' => config('nishalawyer.advocate.years_experience', 15),
            'cases_won' => config('nishalawyer.advocate.cases_won', 420),
            'clients_served' => config('nishalawyer.advocate.clients_served', 180),
            'success_rate' => config('nishalawyer.advocate.success_rate', '96%'),
        ];

        return view('public.home', compact(
            'practiceAreas',
            'featuredPracticeAreas',
            'featuredTestimonials',
            'featuredPosts',
            'recentPosts',
            'stats'
        ));
    }
}