<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    @php
        $pageTitle = $title ?? (config('nishalawyer.advocate.name', 'NishaLawyer') . ' - Premium Legal Services');
        $metaDescription = $metaDescription ?? config('nishalawyer.advocate.bio', 'Premium legal services with compassion and expertise.');
    @endphp

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ Str::limit(strip_tags($metaDescription), 160) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Bootstrap Icons via CDN for broader compatibility --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    @stack('styles')
</head>
<body class="font-sans antialiased text-gray-800 bg-white">

    @include('components.public.navbar')

    @if (session('success'))
        <div class="fixed top-4 right-4 z-50 max-w-md w-full">
            <div class="p-4 rounded-lg shadow-lg bg-green-100 border border-green-200 text-green-800 animate-fadeIn">
                <div class="flex items-start">
                    <i class="bi bi-check-circle-fill text-2xl mr-3 mt-0.5 flex-shrink-0"></i>
                    <div>{{ session('success') }}</div>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="fixed top-4 right-4 z-50 max-w-md w-full">
            <div class="p-4 rounded-lg shadow-lg bg-red-100 border border-red-200 text-red-800 animate-fadeIn">
                <div class="flex items-start">
                    <i class="bi bi-exclamation-triangle-fill text-2xl mr-3 mt-0.5 flex-shrink-0"></i>
                    <div>{{ session('error') }}</div>
                </div>
            </div>
        </div>
    @endif

    @yield('content')

    @include('components.public.footer')

    @stack('scripts')
</body>
</html>