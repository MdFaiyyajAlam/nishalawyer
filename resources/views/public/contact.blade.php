@extends('layouts.app')

@section('title', 'Contact Us - ' . config('nishalawyer.advocate.name'))
@section('metaDescription', 'Get in touch with our legal team. Contact us for consultations, inquiries and legal assistance.')

@push('styles')
<style>
    .contact-hero {
        background: linear-gradient(rgba(10, 25, 47, 0.88), rgba(10, 25, 47, 0.92)), url('{{ asset('images/contact-hero.jpg') }}');
        background-size: cover;
        background-position: center;
        padding: 8rem 0 5rem;
    }
</style>
@endpush

@section('content')

<section class="contact-hero text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block px-4 py-1 gold-gradient text-primary font-semibold text-sm rounded-full mb-4">
            <i class="bi bi-envelope me-1"></i> Get in Touch
        </span>
        <h1 class="font-display text-4xl md:text-5xl font-bold leading-tight mb-4">Contact Us</h1>
        <p class="text-lg text-gray-300 max-w-2xl mx-auto">We're here to help. Reach out for confidential legal assistance.</p>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div class="space-y-6">
                <h2 class="font-display text-3xl font-bold text-primary mb-6">Contact Information</h2>

                <div class="bg-white rounded-xl p-6 shadow-sm flex items-start">
                    <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="bi bi-geo-alt text-2xl text-gold"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-primary mb-1">Office Address</h3>
                        <p class="text-gray-600">{{ config('nishalawyer.contact.address') }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm flex items-start">
                    <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="bi bi-telephone text-2xl text-gold"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-primary mb-1">Phone</h3>
                        <p class="text-gray-600">{{ config('nishalawyer.contact.phone') }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm flex items-start">
                    <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="bi bi-envelope text-2xl text-gold"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-primary mb-1">Email</h3>
                        <p class="text-gray-600">{{ config('nishalawyer.contact.email') }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm flex items-start">
                    <div class="w-12 h-12 gold-bg bg-opacity-10 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="bi bi-clock text-2xl text-gold"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-primary mb-1">Business Hours</h3>
                        <p class="text-gray-600">{{ config('nishalawyer.contact.business_hours') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-8 shadow-lg">
                <h2 class="font-display text-2xl font-bold text-primary mb-6">Send Us a Message</h2>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Your Name</label>
                        <input type="text" name="name" required value="{{ old('name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gold">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" required value="{{ old('email') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gold">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone (optional)</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gold">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <input type="text" name="subject" required value="{{ old('subject') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gold">
                        @error('subject') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea name="message" rows="5" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gold">{{ old('message') }}</textarea>
                        @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="w-full gold-gradient text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all">
                        <i class="bi bi-send me-2"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
