<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
@props(['title' => 'Admin Dashboard', 'header' => 'Dashboard'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Dashboard - {{ config('nishalawyer.advocate.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Dashboard' }} - {{ config('nishalawyer.advocate.name') }}</title>
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased">
@php
    $user = auth()->user();
@endphp
<div class="flex h-screen overflow-hidden">
    <aside id="admin-sidebar" class="admin-sidebar text-white w-64 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto custom-scrollbar">
        <div class="py-6">
            <div class="flex items-center justify-center mb-8">
                <span class="text-2xl font-display font-bold gold-text-gradient">
                    {{ config('nishalawyer.advocate.name') }}
                </span>
            </div>
            <nav class="px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center px-3 py-2">
                    <i class="bi bi-speedometer2 mr-3"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }} flex items-center px-3 py-2">
                    <i class="bi bi-people mr-3"></i><span>Users</span>
                </a>
                <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }} flex items-center px-3 py-2">
                    <i class="bi bi-shield-lock mr-3"></i><span>Roles & Permissions</span>
                </a>
                <a href="{{ route('admin.cases.index') }}" class="nav-link {{ request()->routeIs('admin.cases.*') ? 'active' : '' }} flex items-center px-3 py-2">
                    <i class="bi bi-folder-documents mr-3"></i><span>Cases</span>
                </a>
                <a href="{{ route('admin.appointments.index') }}" class="nav-link {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }} flex items-center px-3 py-2">
                    <i class="bi bi-calendar-check mr-3"></i><span>Appointments</span>
                </a>
                <a href="{{ route('admin.documents.index') }}" class="nav-link {{ request()->routeIs('admin.documents.*') ? 'active' : '' }} flex items-center px-3 py-2">
                    <i class="bi bi-file-earmark-text mr-3"></i><span>Documents</span>
                </a>
                <a href="{{ route('admin.legal-notices.index') }}" class="nav-link {{ request()->routeIs('admin.legal-notices.*') ? 'active' : '' }} flex items-center px-3 py-2">
                    <i class="bi bi-receipt-cutoff mr-3"></i><span>Legal Notices</span>
                </a>
                <a href="{{ route('admin.blog.index') }}" class="nav-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }} flex items-center px-3 py-2">
                    <i class="bi bi-blog mr-3"></i><span>Blog</span>
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }} flex items-center px-3 py-2">
                    <i class="bi bi-chat-quote mr-3"></i><span>Testimonials</span>
                </a>
                <a href="{{ route('admin.practice-areas.index') }}" class="nav-link {{ request()->routeIs('admin.practice-areas.*') ? 'active' : '' }} flex items-center px-3 py-2">
                    <i class="bi bi-gavel mr-3"></i><span>Practice Areas</span>
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }} flex items-center px-3 py-2">
                    <i class="bi bi-envelope mr-3"></i><span>Messages</span>
                </a>
                <a href="{{ route('admin.consultations.index') }}" class="nav-link {{ request()->routeIs('admin.consultation-requests.*') ? 'active' : '' }} flex items-center px-3 py-2">
                    <i class="bi bi-clock-history mr-3"></i><span>Consultations</span>
                </a>
                <a href="{{ route('admin.faqs.index') }}" class="nav-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }} flex items-center px-3 py-2">
                    <i class="bi bi-question-circle mr-3"></i><span>FAQs</span>
                </a>
                <a href="{{ route('admin.pages.index') }}" class="nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }} flex items-center px-3 py-2">
                    <i class="bi bi-file-text mr-3"></i><span>Pages</span>
                </a>
                <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }} flex items-center px-3 py-2">
                    <i class="bi bi-gear mr-3"></i><span>Settings</span>
                </a>
                <a href="{{ route('admin.reports.index') }}" class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }} flex items-center px-3 py-2">
                    <i class="bi bi-graph-up-arrow mr-3"></i><span>Reports</span>
                </a>
                <hr class="border-gray-700 my-4">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link flex items-center px-3 py-2">
                    <i class="bi bi-box-arrow-right mr-3"></i><span>Logout</span>
                </a>
            </nav>
        </div>
    </aside>
    <div class="flex flex-col flex-1 overflow-hidden">
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="flex items-center justify-between h-16 px-6">
                <div class="flex items-center">
                    <button id="sidebar-toggle" class="md:hidden text-gray-600 hover:text-primary mr-4">
                        <i class="bi bi-list text-2xl"></i>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-800">{{ $header ?? 'Dashboard' }}</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="flex items-center space-x-2 text-gray-700 hover:text-primary focus:outline-none">
                            <img src="{{ $user->avatar_url ?? asset('images/default-avatar.png') }}" alt="{{ $user->full_name }}" class="w-8 h-8 rounded-full object-cover">
                            <span class="hidden sm:block text-sm font-medium">{{ $user->first_name }}</span>
                            <i class="bi bi-chevron-down text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <main class="flex-1 overflow-y-auto custom-scrollbar bg-gray-50">
            <div class="p-6">
                @yield('content')
            </div>
        </main>
    </div>
</div>
<form id="logout-form" method="POST" action="{{ route('logout') }}">
    @csrf
</form>
@stack('scripts')
</body>
</html>
