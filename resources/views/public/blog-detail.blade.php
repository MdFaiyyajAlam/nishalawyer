@extends('layouts.app')

@section('title', $post->title . ' - ' . config('nishalawyer.advocate.name'))
@section('metaDescription', $post->meta_description ?? $post->excerpt ?? 'Read our latest legal insights.')

@section('content')

<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-sm text-gray-500 mb-6">
            <a href="{{ route('blog') }}" class="hover:text-gold transition-colors">Blog</a>
            <i class="bi bi-chevron-right mx-2 text-xs"></i>
            <span class="text-gray-700">{{ $post->title }}</span>
        </nav>

        <article class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="h-64 overflow-hidden">
                @if ($post->featured_image)
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100"><i class="bi bi-image text-6xl"></i></div>
                @endif
            </div>
            <div class="p-8 md:p-12">
                <div class="flex items-center text-xs text-gray-500 mb-4 flex-wrap gap-2">
                    <span class="bg-gold text-primary px-2 py-1 rounded-full text-xs font-semibold">{{ $post->category->name ?? 'General' }}</span>
                    <span>&middot;</span>
                    <span>{{ $post->published_at?->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</span>
                    <span>&middot;</span>
                    <span>By {{ $post->author?->full_name ?? config('nishalawyer.advocate.name') }}</span>
                </div>

                <h1 class="font-display text-3xl md:text-4xl font-bold text-primary mb-8">{{ $post->title }}</h1>

                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    {!! $post->content !!}
                </div>

                @if ($post->tags->count())
                    <div class="flex flex-wrap gap-2 mt-8 pt-8 border-t border-gray-100">
                        @foreach ($post->tags as $tag)
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </article>

        {{-- Share / CTA --}}
        <div class="mt-8 bg-primary text-white rounded-xl p-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h3 class="font-display text-xl font-bold text-gold mb-1">Need Legal Advice?</h3>
                <p class="text-gray-300 text-sm">Speak to a professional about your specific situation.</p>
            </div>
            <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 gold-gradient text-white rounded-lg font-semibold whitespace-nowrap">Book Consultation</a>
        </div>

        {{-- Related Posts --}}
        @if ($relatedPosts->count())
            <section class="mt-16">
                <h2 class="font-display text-2xl font-bold text-primary mb-8">Related Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($relatedPosts as $related)
                        <article class="bg-white rounded-xl overflow-hidden hover:shadow-xl transition-shadow">
                            <div class="h-36 overflow-hidden">
                                @if ($related->featured_image)
                                    <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100"><i class="bi bi-image text-3xl"></i></div>
                                @endif
                            </div>
                            <div class="p-5">
                                <h3 class="font-display text-base font-bold text-primary mb-2">
                                    <a href="{{ route('blog.show', $related->slug) }}" class="hover:text-gold block">{{ $related->title }}</a>
                                </h3>
                                <a href="{{ route('blog.show', $related->slug) }}" class="text-gold font-semibold text-sm">Read More <i class="bi bi-arrow-right ms-1"></i></a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</section>

@endsection