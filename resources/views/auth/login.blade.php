@extends('layouts.auth')

@section('title', 'Login')
@section('subtitle', 'Access your account')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <div class="w-16 h-16 gold-bg bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-person-check text-3xl text-gold"></i>
            </div>
            <h1 class="font-display text-2xl font-bold text-primary">Welcome Back</h1>
            <p class="text-gray-500 text-sm">Sign in to access your account</p>
        </div>

        @if (session('status'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" required value="{{ old('email') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gold" placeholder="you@example.com">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gold" placeholder="••••••••">
            </div>
            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm text-gray-600">
                    <input type="checkbox" name="remember" class="mr-2 accent-[#c5a16e]"> Remember me
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-gold hover:text-gold-dark">Forgot password?</a>
            </div>
            <button type="submit" class="w-full gold-gradient text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all">
                <i class="bi bi-box-arrow-in-right me-2"></i> Sign In
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Don't have an account? <a href="{{ route('register') }}" class="text-gold font-semibold hover:text-gold-dark">Sign Up</a>
        </p>
    </div>
</div>
@endsection