<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if ($keyword) {
            $posts = $this->blogService->searchPosts($keyword, 9);
        } else {
            $posts = $this->blogService->getPublishedPosts(9);
        }

        $categories = $this->blogService->getCategoriesWithPostCount();
        $popularTags = $this->blogService->getPopularTags(10);
        $recentPosts = $this->blogService->getRecentPosts(5);

        return view('public.blog', compact('posts', 'categories', 'popularTags', 'recentPosts'));
    }

    public function show(string $slug)
    {
        $post = $this->blogService->getPostBySlug($slug);

        $relatedPosts = BlogPost::where('category_id', $post->category_id)
            ->where('status', 'published')
            ->where('id', '!=', $post->id)
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('public.blog-detail', compact('post', 'relatedPosts'));
    }
}