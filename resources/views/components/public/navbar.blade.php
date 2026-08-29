@php
    $navLinks = [
        ['name' => 'Home', 'url' => route('home'), 'active' => request()->routeIs('home')],
        ['name' => 'About', 'url' => route('about'), 'active' => request()->routeIs('about')],
        ['name' => 'Practice Areas', 'url' => route('practice-areas'), 'active' => request()->routeIs('practice-areas*')],
        ['name' => 'Legal Blog', 'url' => route('blog'), 'active' => request()->routeIs('blog*')],
        ['name' => 'FAQ', 'url' => route('faq'), 'active' => request()->routeIs('faq')],
        ['name' => 'Contact', 'url' => route('contact'), 'active' => request()->routeIs('contact')],
    ];
@endphp

<nav class="bg-white shadow-lg fixed w-full z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <span class="text-2xl font-display font-bold gold-text-gradient">
                        {{ config('nishalawyer.advocate.name') }}
                    </span>
                </a>
            </div>

            <div class="hidden md:ml-8 md:flex md:items-center md:space-x-8">
                @foreach ($navLinks as $link)
                    <a href="{{ $link['url'] }}"
                       class="{{ $link['active'] ? 'text-primary border-primary' : 'text-gray-600 hover:text-primary' }} px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gold transition-all duration-300">
                        {{ $link['name'] }}
                    </a>
                @endforeach
                @auth
                    @if (auth()->user()->isClient())
                        <a href="{{ route('client.dashboard') }}" class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium transition-all duration-300">
                            <i class="bi bi-speedometer2 mr-1"></i>Dashboard
                        </a>
                    @endif
                    @if (auth()->user()->isAdmin() || auth()->user()->isAdvocate())
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium transition-all duration-300">
                            <i class="bi bi-speedometer2 mr-1"></i>Admin Panel
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline-block">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium transition-all duration-300">
                            <i class="bi bi-box-arrow-right mr-1"></i>Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium transition-all duration-300">
                        <i class="bi bi-person mr-1"></i>Login
                    </a>
                    <a href="{{ route('register') }}" class="gold-gradient text-white px-5 py-2 rounded-full text-sm font-medium hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                        Sign Up
                    </a>
                @endauth
            </div>

            <div class="md:hidden flex items-center">
                <button type="button" class="text-gray-600 hover:text-primary focus:outline-none focus:text-primary" id="mobile-menu-button" aria-label="Toggle menu">
                    <i class="bi bi-list text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu (toggled by app.js) --}}
    <div id="mobile-menu" class="md:hidden hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            @foreach ($navLinks as $link)
                <a href="{{ $link['url'] }}"
                   class="{{ $link['active'] ? 'bg-primary text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }} block px-3 py-2 rounded-md text-base font-medium transition-all duration-300">
                    {{ $link['name'] }}
                </a>
            @endforeach
            @auth
                @if (auth()->user()->isClient())
                    <a href="{{ route('client.dashboard') }}" class="text-gray-600 hover:bg-gray-50 block px-3 py-2 rounded-md text-base font-medium">
                        Dashboard
                    </a>
                @endif
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-gray-600 hover:bg-gray-50 block px-3 py-2 rounded-md text-base font-medium">
                    Logout
                </a>
            @else
                <a href="{{ route('login') }}" class="text-gray-600 hover:bg-gray-50 block px-3 py-2 rounded-md text-base font-medium">
                    Login
                </a>
                <a href="{{ route('register') }}" class="gold-gradient text-white block px-3 py-2 rounded-md text-base font-medium text-center">
                    Sign Up
                </a>
            @endauth
        </div>
    </div>
</nav>