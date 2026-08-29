@extends('layouts.auth')

@section('title', 'Reset Password')
@section('subtitle', 'Set a new password')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <div class="w-16 h-16 gold-bg bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-shield-lock text-3xl text-gold"></i>
            </div>
            <h1 class="font-display text-2xl font-bold text-primary">Set New Password</h1>
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

        <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" required value="{{ $email ?? old('email') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gold">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gold" placeholder="At least 8 characters">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gold" placeholder="Repeat password">
            </div>
            <button type="submit" class="w-full gold-gradient text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all">
                <i class="bi bi-check-circle me-2"></i> Reset Password
            </button>
        </form>
    </div>
</div>
@endsection