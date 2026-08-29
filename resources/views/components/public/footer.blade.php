<footer class="bg-primary text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <div class="col-span-1">
                <div class="flex items-center mb-4">
                    <span class="text-3xl font-display font-bold gold-text-gradient">
                        {{ config('nishalawyer.advocate.name') }}
                    </span>
                </div>
                <p class="text-gray-300 text-sm mb-6 leading-relaxed">
                    {{ config('nishalawyer.advocate.bio') }}
                </p>
                <div class="flex space-x-4">
                    <a href="{{ $footerContact['facebook'] }}" class="w-10 h-10 rounded-full bg-primary-light flex items-center justify-center text-gold hover:bg-gold hover:text-primary transition-all duration-300">
                        <i class="bi bi-facebook fs-5"></i>
                    </a>
                    <a href="{{ $footerContact['linkedin'] }}" class="w-10 h-10 rounded-full bg-primary-light flex items-center justify-center text-gold hover:bg-gold hover:text-primary transition-all duration-300">
                        <i class="bi bi-linkedin fs-5"></i>
                    </a>
                    <a href="{{ $footerContact['twitter'] }}" class="w-10 h-10 rounded-full bg-primary-light flex items-center justify-center text-gold hover:bg-gold hover:text-primary transition-all duration-300">
                        <i class="bi bi-twitter-x fs-5"></i>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="font-display text-xl font-semibold mb-6 text-gold">Quick Links</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-gold transition-colors duration-300">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-gold transition-colors duration-300">About Us</a></li>
                    <li><a href="{{ route('practice-areas') }}" class="text-gray-300 hover:text-gold transition-colors duration-300">Practice Areas</a></li>
                    <li><a href="{{ route('blog') }}" class="text-gray-300 hover:text-gold transition-colors duration-300">Legal Blog</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-gold transition-colors duration-300">Contact</a></li>
                    <li><a href="{{ route('faq') }}" class="text-gray-300 hover:text-gold transition-colors duration-300">FAQ</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-display text-xl font-semibold mb-6 text-gold">Practice Areas</h3>
                <ul class="space-y-3">
                    @foreach ($footerPracticeAreas as $area)
                        <li><a href="{{ route('practice-area.show', $area->slug) }}" class="text-gray-300 hover:text-gold transition-colors duration-300">{{ $area->title }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="font-display text-xl font-semibold mb-6 text-gold">Contact Info</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <i class="bi bi-map-pin mt-1 mr-3 text-gold text-lg"></i>
                        <p class="text-gray-300 text-sm">{{ $footerContact['address'] }}</p>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-telephone mt-1 mr-3 text-gold"></i>
                        <p class="text-gray-300">{{ $footerContact['phone'] }}</p>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-envelope mt-1 mr-3 text-gold"></i>
                        <p class="text-gray-300">{{ $footerContact['email'] }}</p>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-clock mt-1 mr-3 text-gold"></i>
                        <p class="text-gray-300 text-sm">{{ $footerContact['hours'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-700 pt-8">
            <div class="md:flex justify-center items-center">
                <p class="text-gray-400 text-sm text-center">
                    &copy; {{ date('Y') }} {{ config('nishalawyer.advocate.name') }}. All rights reserved.
                </p>
                <div class="flex items-center space-x-6 mt-4 md:mt-0">
                    <a href="{{ route('privacy-policy') }}" class="text-gray-400 hover:text-gold text-sm transition-colors">Privacy Policy</a>
                    <a href="{{ route('terms-of-service') }}" class="text-gray-400 hover:text-gold text-sm transition-colors">Terms of Service</a>
                    <a href="{{ route('legal-notice') }}" class="text-gray-400 hover:text-gold text-sm transition-colors">Legal Notice</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<button id="back-to-top" class="fixed bottom-8 right-8 w-12 h-12 bg-gold text-white rounded-full shadow-lg hover:bg-gold-dark transition-all duration-300 hidden items-center justify-center z-40">
    <i class="bi bi-arrow-up fs-5"></i>
</button>
