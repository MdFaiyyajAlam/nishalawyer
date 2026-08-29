@extends('layouts.app')

@section('title', 'Practice Areas - ' . config('nishalawyer.advocate.name'))
@section('metaDescription', 'Explore our comprehensive legal practice areas including family law, criminal law, civil law, corporate law and more.')

@push('styles')
<style>
    .pa-hero {
        background: linear-gradient(rgba(10, 25, 47, 0.88), rgba(10, 25, 47, 0.92)), url('{{ asset('images/pa-hero.jpg') }}');
        background-size: cover;
        background-position: center;
        padding: 8rem 0 5rem;
    }
</style>
@endpush

@section('content')

<section class="pa-hero text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block px-4 py-1 gold-gradient text-primary font-semibold text-sm rounded-full mb-4">
            <i class="bi bi-gavel me-1"></i> Our Expertise
        </span>
        <h1 class="font-display text-4xl md:text-5xl font-bold leading-tight mb-4">Areas of Legal Practice</h1>
        <p class="text-lg text-gray-300 max-w-2xl mx-auto">
            Comprehensive legal services tailored to protect your rights and interests.
        </p>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($practiceAreas as $area)
                <div class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 mx-auto mb-6 gold-bg bg-opacity-10 rounded-xl flex items-center justify-center">
                        <i class="bi bi-gavel text-3xl text-gold"></i>
                    </div>
                    <h3 class="font-display text-xl font-bold text-primary mb-3">{{ $area->title }}</h3>
                    <p class="text-gray-600 text-sm mb-6">{{ \Illuminate\Support\Str::limit($area->short_description, 120) }}</p>
                    <a href="{{ route('practice-area.show', $area->slug) }}" class="text-gold font-semibold inline-flex items-center hover:text-gold-dark transition-colors">
                        Learn More <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 py-12">
                    <i class="bi bi-inbox text-5xl mb-4 block"></i>
                    Practice areas coming soon.
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="py-16 primary-bg text-white">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="font-display text-3xl md:text-4xl font-bold mb-4">Not Sure Which Area Covers Your Case?</h2>
        <p class="text-gray-300 text-lg mb-8">Contact us for a free consultation to identify the right legal approach.</p>
        <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gold hover:bg-gold-dark text-primary font-bold rounded-full shadow-lg transform hover:scale-105 transition-all">
            <i class="bi bi-chat-dots me-2"></i> Contact Us Now
        </a>
    </div>
</section>

@endsection