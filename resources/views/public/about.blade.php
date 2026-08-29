@extends('layouts.app')

@section('title', 'About Advocate - ' . config('nishalawyer.advocate.name'))
@section('metaDescription', 'Learn about our advocate, qualifications, experience and approach to legal representation.')

@push('styles')
<style>
    .about-hero {
        background: linear-gradient(rgba(10, 25, 47, 0.88), rgba(10, 25, 47, 0.92)), url('{{ asset('images/about-hero.jpg') }}');
        background-size: cover;
        background-position: center;
        padding: 8rem 0 5rem;
    }
</style>
@endpush

@section('content')

<section class="about-hero text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block px-4 py-1 gold-gradient text-primary font-semibold text-sm rounded-full mb-4">
            <i class="bi bi-award me-1"></i> About Us
        </span>
        <h1 class="font-display text-4xl md:text-5xl font-bold leading-tight mb-4">About Advocate {{ config('nishalawyer.advocate.name') }}</h1>
        <p class="text-lg text-gray-300 max-w-2xl mx-auto">Passionate about justice, committed to our clients.</p>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="relative">
                <img src="{{ asset('images/advocate-profile.jpg') }}" alt="Advocate {{ config('nishalawyer.advocate.name') }}" class="w-full max-w-md mx-auto rounded-2xl shadow-2xl">
                <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-xl shadow-lg hidden sm:block">
                    <div class="text-3xl font-bold gold-text-gradient">{{ config('nishalawyer.advocate.years_experience', 15) }}+</div>
                    <p class="text-sm text-gray-500">Years Experience</p>
                </div>
            </div>
            <div>
                <span class="text-gold font-semibold text-sm uppercase tracking-wider mb-2 block">Our Story</span>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-primary mb-6">A Dedicated Advocate</h2>
                <p class="text-gray-600 text-lg leading-relaxed mb-6">{{ config('nishalawyer.advocate.bio') }}</p>
                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div><div class="text-3xl font-bold gold-text-gradient mb-1">{{ config('nishalawyer.advocate.cases_won', 420) }}+</div><p class="text-sm text-gray-500">Cases Won</p></div>
                    <div><div class="text-3xl font-bold gold-text-gradient mb-1">{{ config('nishalawyer.advocate.clients_served', 180) }}+</div><p class="text-sm text-gray-500">Satisfied Clients</p></div>
                    <div><div class="text-3xl font-bold gold-text-gradient mb-1">{{ config('nishalawyer.advocate.success_rate', '96%') }}</div><p class="text-sm text-gray-500">Success Rate</p></div>
                    <div><div class="text-3xl font-bold gold-text-gradient mb-1">{{ count(config('nishalawyer.advocate.qualifications')) }}</div><p class="text-sm text-gray-500">Credentials</p></div>
                </div>
                <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition-colors">
                    Book a Consultation <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-gold font-semibold text-sm uppercase tracking-wider mb-2 block">Credentials</span>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-primary mb-4">Qualifications & Memberships</h2>
        </div>
        <div class="max-w-3xl mx-auto space-y-5">
            @foreach (config('nishalawyer.advocate.qualifications', []) as $qualification)
                <div class="bg-white rounded-xl shadow-lg p-6 flex items-center">
                    <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center mr-5 flex-shrink-0">
                        <i class="bi bi-patch-check text-2xl text-gold"></i>
                    </div>
                    <p class="text-gray-700 font-medium">{{ $qualification }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-gold font-semibold text-sm uppercase tracking-wider mb-2 block">Our Values</span>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-primary mb-4">What We Stand For</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-8 rounded-xl bg-gray-50 hover:shadow-lg transition-all">
                <div class="w-20 h-20 gold-bg bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-6"><i class="bi bi-shield-check text-3xl text-gold"></i></div>
                <h3 class="font-display text-xl font-bold text-primary mb-3">Integrity</h3>
                <p class="text-gray-600 text-sm">Honest legal counsel with total transparency in every matter.</p>
            </div>
            <div class="text-center p-8 rounded-xl bg-gray-50 hover:shadow-lg transition-all">
                <div class="w-20 h-20 gold-bg bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-6"><i class="bi bi-lightbulb text-3xl text-gold"></i></div>
                <h3 class="font-display text-xl font-bold text-primary mb-3">Expertise</h3>
                <p class="text-gray-600 text-sm">Deep knowledge across family, criminal, civil and corporate law.</p>
            </div>
            <div class="text-center p-8 rounded-xl bg-gray-50 hover:shadow-lg transition-all">
                <div class="w-20 h-20 gold-bg bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-6"><i class="bi bi-heart text-3xl text-gold"></i></div>
                <h3 class="font-display text-xl font-bold text-primary mb-3">Compassion</h3>
                <p class="text-gray-600 text-sm">We listen, understand and genuinely care about every client.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-16 primary-bg text-white">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="font-display text-3xl md:text-4xl font-bold mb-4">Let's Work Together</h2>
        <p class="text-gray-300 text-lg mb-8">Reach out today for a confidential consultation about your legal matter.</p>
        <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gold hover:bg-gold-dark text-primary font-bold rounded-full shadow-lg transform hover:scale-105 transition-all">
            <i class="bi bi-telephone me-2"></i> Contact Us
        </a>
    </div>
</section>

@endsection
