<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogPostResource;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Models\PracticeArea;
use App\Models\Testimonial;
use App\Models\Faq;
use Illuminate\Http\Request;

class PublicApiController extends Controller
{
    public function practiceAreas(Request $request)
    {
        $areas = PracticeArea::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return response()->json($areas);
    }

    public function blogPosts(Request $request)
    {
        $posts = BlogPost::where('status', 'published')
            ->where('published_at', '<=', now())
            ->with(['category', 'author'])
            ->orderByDesc('published_at')
            ->paginate(10);

        return BlogPostResource::collection($posts);
    }

    public function blogPost(string $slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->where('status', 'published')
            ->with(['category', 'author', 'tags'])
            ->first();

        if (! $post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        return new BlogPostResource($post);
    }

    public function testimonials(Request $request)
    {
        $testimonials = Testimonial::where('status', 'approved')
            ->where('is_featured', true)
            ->orderByDesc('created_at')
            ->get();

        return response()->json($testimonials);
    }

    public function faqs(Request $request)
    {
        $faqs = Faq::where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        return response()->json($faqs);
    }

    public function blogCategories()
    {
        $categories = BlogCategory::where('is_active', true)
            ->withCount('posts')
            ->having('posts_count', '>', 0)
            ->orderBy('name')
            ->get();

        return response()->json($categories);
    }

    public function blogTags()
    {
        $tags = BlogTag::withCount('posts')
            ->having('posts_count', '>', 0)
            ->orderByDesc('posts_count')
            ->limit(10)
            ->get();

        return response()->json($tags);
    }
}