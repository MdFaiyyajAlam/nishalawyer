@extends('layouts.auth')

@section('title', 'Forgot Password')
@section('subtitle', 'Reset your password')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <div class="w-16 h-16 gold-bg bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-key text-3xl text-gold"></i>
            </div>
            <h1 class="font-display text-2xl font-bold text-primary">Forgot Password?</h1>
            <p class="text-gray-500 text-sm">Enter your email and we'll send you a reset link.</p>
        </div>

        @if (session('status'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" required value="{{ old('email') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gold" placeholder="you@example.com">
            </div>
            <button type="submit" class="w-full gold-gradient text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all">
                <i class="bi bi-envelope me-2"></i> Send Reset Link
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Remembered? <a href="{{ route('login') }}" class="text-gold font-semibold hover:text-gold-dark">Sign In</a>
        </p>
    </div>
</div>
@endsection