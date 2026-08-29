<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $metaDescription ?? 'NishaLawyer - Premium Legal Services' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'NishaLawyer' }} - {{ $subtitle ?? 'Premium Legal Services' }}</title>

    @vite(['resources/css/app.css'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">

    <div class="fixed top-0 left-0 w-full h-2 bg-gradient-to-r from-primary to-gold"></div>

    <div class="w-full max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between mb-8">
            <a href="{{ route('home') }}" class="flex items-center space-x-2 mb-4 md:mb-0">
                <span class="text-3xl font-display font-bold gold-text-gradient">
                    {{ config('nishalawyer.advocate.name') }}
                </span>
            </a>
        </div>

        @yield('content')

        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ config('nishalawyer.advocate.name') }}. All rights reserved.
            </p>
        </div>
    </div>

    <script>
        // Form validation
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        });
    </script>
</body>
</html>