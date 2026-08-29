<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogPostRequest;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::with(['category', 'author']);

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->orderByDesc('created_at')->paginate(15);

        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        $tags = BlogTag::all();
        $authors = \App\Models\User::whereHas('role', function ($q) {
            $q->whereIn('slug', ['admin', 'advocate']);
        })->get();

        return view('admin.blog.create', compact('categories', 'tags', 'authors'));
    }

    public function store(BlogPostRequest $request)
    {
        $data = $request->validated();
        $data['author_id'] = auth()->id();

        if ($data['status'] === 'published' && ! isset($data['published_at'])) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        if (! isset($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $post = BlogPost::create($data);

        if (! empty($data['tags'])) {
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post created successfully!');
    }

    public function show(BlogPost $blogPost)
    {
        $blogPost->load(['category', 'author', 'tags']);
        return view('admin.blog.show', compact('blogPost'));
    }

    public function edit(BlogPost $blogPost)
    {
        $categories = BlogCategory::all();
        $tags = BlogTag::all();
        $authors = \App\Models\User::whereHas('role', function ($q) {
            $q->whereIn('slug', ['admin', 'advocate']);
        })->get();

        $blogPost->load('tags');

        return view('admin.blog.edit', compact('blogPost', 'categories', 'tags', 'authors'));
    }

    public function update(BlogPostRequest $request, BlogPost $blogPost)
    {
        $data = $request->validated();

        if ($data['status'] === 'published' && ! $blogPost->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            if ($blogPost->featured_image) {
                \Storage::disk('public')->delete($blogPost->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $blogPost->update($data);

        if (! empty($data['tags'])) {
            $blogPost->tags()->sync($data['tags']);
        } else {
            $blogPost->tags()->sync([]);
        }

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post updated successfully!');
    }

    public function destroy(BlogPost $blogPost)
    {
        if ($blogPost->featured_image) {
            \Storage::disk('public')->delete($blogPost->featured_image);
        }

        $blogPost->delete();

        return back()->with('success', 'Blog post deleted successfully!');
    }
}