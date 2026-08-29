@extends('layouts.auth')

@section('title', 'Register')
@section('subtitle', 'Create your account')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <div class="w-16 h-16 gold-bg bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-person-plus text-3xl text-gold"></i>
            </div>
            <h1 class="font-display text-2xl font-bold text-primary">Create Account</h1>
            <p class="text-gray-500 text-sm">Join {{ config('nishalawyer.advocate.name') }} to track cases, book appointments and manage documents.</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" name="first_name" required value="{{ old('first_name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gold" placeholder="John">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="last_name" required value="{{ old('last_name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gold" placeholder="Doe">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" required value="{{ old('email') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gold" placeholder="you@example.com">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone (optional)</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gold" placeholder="+91-98765-43210">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gold" placeholder="At least 8 characters">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gold" placeholder="Repeat password">
            </div>
            <button type="submit" class="w-full gold-gradient text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all">
                <i class="bi bi-person-plus me-2"></i> Create Account
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Already have an account? <a href="{{ route('login') }}" class="text-gold font-semibold hover:text-gold-dark">Sign In</a>
        </p>
    </div>
</div>
@endsection