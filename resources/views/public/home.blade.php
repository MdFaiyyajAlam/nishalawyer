@extends('layouts.app')

@section('title', config('nishalawyer.advocate.name', 'NishaLawyer') . ' - Premium Legal Services')
@section('metaDescription', config('nishalawyer.advocate.bio', 'Premium legal services with compassion and expertise.'))

@push('styles')
<style>
    .hero-section {
        background-image: linear-gradient(rgba(10, 25, 47, 0.88), rgba(10, 25, 47, 0.92)), url('{{ asset('images/hero-bg.jpg') }}');
        background-size: cover;
        background-position: center;
        min-height: 90vh;
    }
</style>
@endpush

@section('content')

{{-- ===== 1. Hero Banner ===== --}}
<section class="hero-section flex items-center text-white relative overflow-hidden py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-fadeInUp">
                <span class="inline-block px-4 py-1 gold-gradient text-primary font-semibold text-sm rounded-full mb-4">
                    <i class="bi bi-award me-1"></i> Advocate {{ config('nishalawyer.advocate.name') }} - Bar Council Certified
                </span>
                <h1 class="font-display text-4xl md:text-5xl xl:text-6xl font-bold text-white leading-tight mb-6">
                    Your Trusted Legal <span class="gold-text-gradient">Partner</span>
                </h1>
                <p class="text-lg text-gray-300 mb-8 leading-relaxed">
                    {{ config('nishalawyer.advocate.tagline', 'With over 15 years of experience, we provide premium legal counsel to protect your rights.') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gold hover:bg-gold-dark text-primary font-semibold rounded-full shadow-lg transform hover:scale-105 transition-all">
                        <i class="bi bi-calendar-check me-2"></i> Book a Consultation
                    </a>
                    <a href="{{ route('practice-areas') }}" class="inline-flex items-center justify-center px-8 py-4 border-2 border-gold text-gold font-semibold rounded-full hover:bg-gold hover:text-primary transform hover:scale-105 transition-all">
                        <i class="bi bi-gavel me-2"></i> View Practice Areas
                    </a>
                </div>
            </div>

            {{-- Appointment / Consultation quick form --}}
            <div class="relative animate-fadeIn" style="animation-delay: 200ms;">
                <div class="glass-effect rounded-2xl p-6 shadow-2xl">
                    <h3 class="text-xl font-display font-semibold text-white mb-4">Request a Consultation</h3>
                    <form action="{{ route('consultation.request.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="text" name="name" required placeholder="Full Name" class="w-full px-4 py-3 bg-gray-800/50 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-gold">
                        <input type="email" name="email" required placeholder="Email Address" class="w-full px-4 py-3 bg-gray-800/50 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-gold">
                        <input type="tel" name="phone" required placeholder="Phone Number" class="w-full px-4 py-3 bg-gray-800/50 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-gold">
                        <select name="practice_area_id" class="w-full px-4 py-3 bg-gray-800/50 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-gold">
                            <option value="">Select Practice Area</option>
                            @foreach ($practiceAreas as $pa)
                                <option value="{{ $pa->id }}">{{ $pa->title }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="w-full gold-gradient text-white py-3 rounded-lg font-semibold">
                            <i class="bi bi-send me-2"></i> Request Consultation
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== 2. About Advocate ===== --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-fadeInUp">
                <span class="text-gold font-semibold text-sm uppercase tracking-wider mb-2 block">About Advocate</span>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-primary mb-6">Dedicated to Your Legal Excellence</h2>
                <p class="text-gray-600 text-lg mb-6 leading-relaxed">{{ config('nishalawyer.advocate.bio') }}</p>
                <div class="space-y-3 mb-8">
                    <div class="flex items-center">
                        <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center mr-4">
                            <i class="bi bi-award text-2xl text-gold"></i>
                        </div>
                        <p class="font-semibold text-primary">{{ $stats['years_experience'] }}+ Years Experience</p>
                    </div>
                    <div class="flex items-center">
                        <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center mr-4">
                            <i class="bi bi-graph-up text-2xl text-gold"></i>
                        </div>
                        <p class="font-semibold text-primary">{{ $stats['cases_won'] }}+ Cases Won</p>
                    </div>
                    <div class="flex items-center">
                        <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center mr-4">
                            <i class="bi bi-people text-2xl text-gold"></i>
                        </div>
                        <p class="font-semibold text-primary">{{ $stats['clients_served'] }}+ Satisfied Clients</p>
                    </div>
                </div>
                <a href="{{ route('about') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark">
                    Learn More <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
            <div class="relative">
                <div class="w-full max-w-sm mx-auto">
                    <img src="{{ asset('images/advocate-profile.jpg') }}" alt="Advocate Nisha" class="w-full rounded-2xl shadow-2xl object-cover">
                    <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-xl shadow-lg hidden sm:block">
                        <div class="text-center">
                            <div class="text-3xl font-bold gold-text-gradient">{{ $stats['success_rate'] }}</div>
                            <p class="text-sm text-gray-500">Success Rate</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== 3. Practice Areas ===== --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-gold font-semibold text-sm uppercase tracking-wider mb-2 block">Our Expertise</span>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-primary mb-4">Areas of Legal Practice</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($featuredPracticeAreas as $area)
                <div class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-2xl transform hover:-translate-y-2 transition-all">
                    <div class="w-16 h-16 mx-auto mb-6 gold-gradient bg-opacity-10 rounded-xl flex items-center justify-center">
                        <i class="bi bi-gavel text-3xl text-gold"></i>
                    </div>
                    <h3 class="font-display text-xl font-bold text-primary mb-3">{{ $area->title }}</h3>
                    <p class="text-gray-600 text-sm mb-6">{{ \Illuminate\Support\Str::limit($area->short_description, 120) }}</p>
                    <a href="{{ route('practice-area.show', $area->slug) }}" class="text-gold font-semibold inline-flex items-center">
                        Learn More <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('practice-areas') }}" class="inline-flex items-center px-6 py-3 gold-gradient text-white rounded-lg font-semibold">View All Practice Areas</a>
        </div>
    </div>
</section>

{{-- ===== 4. Why Choose Us ===== --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-gold font-semibold text-sm uppercase tracking-wider mb-2 block">Why Choose Us</span>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-primary mb-4">What Makes Us Different</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-8 rounded-xl bg-gray-50 hover:shadow-lg transition-all">
                <div class="w-20 h-20 gold-bg bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="bi bi-award text-3xl text-gold"></i>
                </div>
                <h3 class="font-display text-xl font-bold text-primary mb-3">Proven Track Record</h3>
                <p class="text-gray-600 text-sm">With {{ $stats['years_experience'] }}+ years of experience and hundreds of successful cases, your matters are in capable hands.</p>
            </div>
            <div class="text-center p-8 rounded-xl bg-gray-50 hover:shadow-lg transition-all">
                <div class="w-20 h-20 gold-bg bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="bi bi-heart-pulse text-3xl text-gold"></i>
                </div>
                <h3 class="font-display text-xl font-bold text-primary mb-3">Personalized Attention</h3>
                <p class="text-gray-600 text-sm">We take time to understand your unique situation and goals for every case.</p>
            </div>
            <div class="text-center p-8 rounded-xl bg-gray-50 hover:shadow-lg transition-all">
                <div class="w-20 h-20 gold-bg bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="bi bi-shield-check text-3xl text-gold"></i>
                </div>
                <h3 class="font-display text-xl font-bold text-primary mb-3">Transparent Communication</h3>
                <p class="text-gray-600 text-sm">Keeping you informed at every stage of your legal journey.</p>
            </div>
        </div>
    </div>
</section>

{{-- ===== 5. Statistics ===== --}}
<section class="py-16 primary-bg text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div><div class="text-4xl font-bold gold-text-gradient mb-2">{{ $stats['years_experience'] }}+</div><p class="text-gray-300">Years Experience</p></div>
            <div><div class="text-4xl font-bold gold-text-gradient mb-2">{{ $stats['cases_won'] }}+</div><p class="text-gray-300">Cases Won</p></div>
            <div><div class="text-4xl font-bold gold-text-gradient mb-2">{{ $stats['clients_served'] }}+</div><p class="text-gray-300">Happy Clients</p></div>
            <div><div class="text-4xl font-bold gold-text-gradient mb-2">{{ $stats['success_rate'] }}</div><p class="text-gray-300">Success Rate</p></div>
        </div>
    </div>
</section>

{{-- ===== 6. Testimonials ===== --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-gold font-semibold text-sm uppercase tracking-wider mb-2 block">Client Stories</span>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-primary mb-4">What Our Clients Say</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($featuredTestimonials as $testimonial)
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition-shadow">
                    <div class="flex items-center mb-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="bi {{ $i <= $testimonial->rating ? 'bi-star-fill' : 'bi-star' }} text-gold"></i>
                        @endfor
                    </div>
                    <p class="text-gray-700 italic mb-6 leading-relaxed">&ldquo;{{ \Illuminate\Support\Str::limit($testimonial->content, 180) }}&rdquo;</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex-shrink-0 mr-3 flex items-center justify-center text-gray-400">
                            <i class="bi bi-person text-lg"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-primary">{{ $testimonial->client_name }}</p>
                            <p class="text-sm text-gray-500">{{ $testimonial->client_title }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== 8. Legal Blog ===== --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12">
            <div>
                <span class="text-gold font-semibold text-sm uppercase tracking-wider mb-2 block">Latest Insights</span>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-primary">Legal Blog</h2>
            </div>
            <a href="{{ route('blog') }}" class="text-gold font-semibold hover:text-gold-dark inline-flex items-center">View All Posts <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($recentPosts as $post)
                <article class="bg-gray-50 rounded-xl overflow-hidden hover:shadow-xl transform hover:-translate-y-1 transition-all">
                    <div class="h-48 overflow-hidden">
                        @if ($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400"><i class="bi bi-image text-4xl"></i></div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-xs text-gray-500 mb-2">
                            <span class="bg-gold text-primary px-2 py-1 rounded-full text-xs font-semibold">{{ $post->category->name ?? 'General' }}</span>
                            <span class="mx-2">&middot;</span>
                            <span>{{ $post->published_at?->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</span>
                        </div>
                        <h3 class="font-display text-lg font-bold text-primary mb-3">
                            <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-gold">{{ $post->title }}</a>
                        </h3>
                        <a href="{{ route('blog.show', $post->slug) }}" class="text-gold font-semibold text-sm inline-flex items-center">Read More <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== 9. Contact CTA ===== --}}
<section class="py-20 primary-bg text-white">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="font-display text-3xl md:text-4xl font-bold mb-4">Ready to Protect Your Legal Rights?</h2>
        <p class="text-gray-300 text-lg mb-8">Schedule a confidential consultation today.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gold hover:bg-gold-dark text-primary font-bold rounded-full shadow-lg transform hover:scale-105 transition-all">
                <i class="bi bi-telephone me-2"></i> Call Us Now
            </a>
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 border-2 border-gold text-gold font-bold rounded-full hover:bg-gold hover:text-primary transform hover:scale-105 transition-all">
                <i class="bi bi-person-plus me-2"></i> Create Account
            </a>
        </div>
    </div>
</section>

@endsection
