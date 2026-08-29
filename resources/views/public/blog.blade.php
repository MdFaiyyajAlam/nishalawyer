@extends('layouts.app')

@section('title', 'Legal Blog - ' . config('nishalawyer.advocate.name'))
@section('metaDescription', 'Stay informed with our legal blog featuring guides, court judgments, case studies and legal tips.')

@push('styles')
<style>
    .blog-hero {
        background: linear-gradient(rgba(10, 25, 47, 0.88), rgba(10, 25, 47, 0.92)), url('{{ asset('images/blog-hero.jpg') }}');
        background-size: cover;
        background-position: center;
        padding: 8rem 0 5rem;
    }
</style>
@endpush

@section('content')

<section class="blog-hero text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block px-4 py-1 gold-gradient text-primary font-semibold text-sm rounded-full mb-4">
            <i class="bi bi-journal-text me-1"></i> Legal Insights
        </span>
        <h1 class="font-display text-4xl md:text-5xl font-bold leading-tight mb-4">Legal Blog</h1>
        <p class="text-lg text-gray-300 max-w-2xl mx-auto">Guides, judgments and expert analysis on Indian law.</p>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2">
                <form method="GET" action="{{ route('blog') }}" class="mb-10">
                    <div class="flex">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search articles..." class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:outline-none focus:border-gold">
                        <button type="submit" class="px-6 py-3 gold-gradient text-white rounded-r-lg font-semibold"><i class="bi bi-search"></i></button>
                    </div>
                </form>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse ($posts as $post)
                        <article class="bg-white rounded-xl overflow-hidden hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                            <div class="h-44 overflow-hidden">
                                @if ($post->featured_image)
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100"><i class="bi bi-image text-4xl"></i></div>
                                @endif
                            </div>
                            <div class="p-6">
                                <div class="flex items-center text-xs text-gray-500 mb-2">
                                    <span class="bg-gold text-primary px-2 py-1 rounded-full text-xs font-semibold">{{ $post->category->name ?? 'General' }}</span>
                                    <span class="mx-2">&middot;</span>
                                    <span>{{ $post->published_at?->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</span>
                                </div>
                                <h3 class="font-display text-lg font-bold text-primary mb-2">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-gold block">{{ $post->title }}</a>
                                </h3>
                                <p class="text-gray-600 text-sm mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?? $post->content), 130) }}</p>
                                <a href="{{ route('blog.show', $post->slug) }}" class="text-gold font-semibold text-sm inline-flex items-center">Read More <i class="bi bi-arrow-right ms-1"></i></a>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full text-center text-gray-500 py-12">
                            <i class="bi bi-journal-x text-5xl mb-4 block"></i>
                            No articles found. Check back soon.
                        </div>
                    @endforelse
                </div>

                <div class="mt-10">
                    {{ $posts->links() }}
                </div>
            </div>

            <aside class="lg:col-span-1 space-y-8">
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <h3 class="font-display text-xl font-bold text-primary mb-4">Categories</h3>
                    <ul class="space-y-2">
                        @foreach ($categories as $category)
                            <li class="flex items-center justify-between">
                                <a href="{{ route('blog') . '?search=' . urlencode($category->name) }}" class="text-gray-600 hover:text-gold transition-colors">{{ $category->name }}</a>
                                <span class="text-sm text-gray-400">{{ $category->posts_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <h3 class="font-display text-xl font-bold text-primary mb-4">Recent Posts</h3>
                    <ul class="space-y-4">
                        @foreach ($recentPosts as $rp)
                            <li>
                                <a href="{{ route('blog.show', $rp->slug) }}" class="text-sm text-gray-700 hover:text-gold transition-colors font-medium">{{ $rp->title }}</a>
                                <p class="text-xs text-gray-400">{{ $rp->published_at?->format('M d, Y') ?? $rp->created_at->format('M d, Y') }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <h3 class="font-display text-xl font-bold text-primary mb-4">Popular Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($popularTags as $tag)
                            <a href="{{ route('blog') . '?search=' . urlencode($tag->name) }}" class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs hover:bg-gold hover:text-white transition-colors">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

@endsection
