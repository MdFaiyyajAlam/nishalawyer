@extends('layouts.app')

@section('title', $practiceArea->title . ' - ' . config('nishalawyer.advocate.name'))
@section('metaDescription', $practiceArea->short_description)

@push('styles')
<style>
    .pad-hero {
        background: linear-gradient(rgba(10, 25, 47, 0.88), rgba(10, 25, 47, 0.92)), url('{{ asset('images/pa-hero.jpg') }}');
        background-size: cover;
        background-position: center;
        padding: 8rem 0 4rem;
    }
</style>
@endpush

@section('content')

<section class="pad-hero text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-sm text-gray-300 mb-4">
            <a href="{{ route('practice-areas') }}" class="hover:text-gold transition-colors">Practice Areas</a>
            <i class="bi bi-chevron-right mx-2 text-xs"></i>
            <span class="text-gold">{{ $practiceArea->title }}</span>
        </nav>
        <div class="flex items-center">
            <div class="w-16 h-16 bg-gold/20 rounded-xl flex items-center justify-center mr-5">
                <i class="bi bi-gavel text-3xl text-gold"></i>
            </div>
            <div>
                <h1 class="font-display text-4xl md:text-5xl font-bold leading-tight">{{ $practiceArea->title }}</h1>
                <p class="text-lg text-gray-300 mt-2">{{ $practiceArea->short_description }}</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <span class="text-gold font-semibold text-sm uppercase tracking-wider mb-2 block">About This Practice</span>
                <h2 class="font-display text-3xl font-bold text-primary mb-6">Overview of {{ $practiceArea->title }}</h2>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    {!! $practiceArea->description !!}
                </div>
                <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-4 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition-colors mt-8">
                    Discuss This with an Expert <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>

            <aside class="lg:col-span-1 space-y-6">
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="font-display text-xl font-bold text-primary mb-4"><i class="bi bi-question-circle text-gold me-2"></i>FAQs</h3>
                    @forelse ($faqs as $faq)
                        <div class="mb-4">
                            <p class="font-semibold text-gray-800 mb-1">{{ $faq->question }}</p>
                            <p class="text-sm text-gray-600">{{ \Illuminate\Support\Str::limit(strip_tags($faq->answer), 140) }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No FAQs available for this practice area yet.</p>
                    @endforelse
                </div>

                <div class="bg-primary text-white rounded-xl p-6">
                    <h3 class="font-display text-xl font-bold mb-3 text-gold">Need Immediate Help?</h3>
                    <p class="text-sm text-gray-300 mb-4">Call us for a confidential discussion about your case.</p>
                    <p class="font-semibold">{{ config('nishalawyer.advocate.phone') }}</p>
                    <a href="{{ route('contact') }}" class="inline-block mt-4 gold-gradient text-white px-5 py-2 rounded-lg font-semibold">Book a Consult</a>
                </div>
            </aside>
        </div>
    </div>
</section>

@endsection