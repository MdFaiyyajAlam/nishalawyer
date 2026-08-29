<?php

namespace App\Services;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class BlogService
{
    public function getPublishedPosts(int $perPage = 10): LengthAwarePaginator
    {
        return BlogPost::where('status', 'published')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->paginate($perPage);
    }

    public function getFeaturedPosts(int $limit = 5): \Illuminate\Database\Eloquent\Collection
    {
        return BlogPost::where('status', 'published')
            ->where('is_featured', true)
            ->orderByDesc('published_at')
            ->limit($limit)
            ->get();
    }

    public function getRecentPosts(int $limit = 5): \Illuminate\Database\Eloquent\Collection
    {
        return BlogPost::where('status', 'published')
            ->orderByDesc('published_at')
            ->limit($limit)
            ->get();
    }

    public function getPostsByCategory(string $slug, int $perPage = 10): LengthAwarePaginator
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();

        return BlogPost::where('category_id', $category->id)
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->paginate($perPage);
    }

    public function getPostBySlug(string $slug): ?BlogPost
    {
        return BlogPost::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
    }

    public function searchPosts(string $keyword, int $perPage = 10): LengthAwarePaginator
    {
        return BlogPost::where('status', 'published')
            ->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%{$keyword}%")
                    ->orWhere('content', 'like', "%{$keyword}%")
                    ->orWhere('excerpt', 'like', "%{$keyword}%");
            })
            ->orderByDesc('published_at')
            ->paginate($perPage);
    }

    public function getCategoriesWithPostCount(): \Illuminate\Database\Eloquent\Collection
    {
        return BlogCategory::where('is_active', true)
            ->withCount('posts')
            ->having('posts_count', '>', 0)
            ->orderBy('name')
            ->get();
    }

    public function getPopularTags(int $limit = 10): \Illuminate\Database\Eloquent\Collection
    {
        return BlogTag::withCount('posts')
            ->orderByDesc('posts_count')
            ->limit($limit)
            ->get();
    }
}