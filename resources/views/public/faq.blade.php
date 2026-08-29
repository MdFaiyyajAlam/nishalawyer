@extends('layouts.app')

@section('title', 'FAQ - ' . config('nishalawyer.advocate.name'))
@section('metaDescription', 'Frequently asked questions about our legal services, consultations, appointments and processes.')

@push('styles')
<style>
    .faq-hero {
        background: linear-gradient(rgba(10, 25, 47, 0.88), rgba(10, 25, 47, 0.92)), url('{{ asset('images/faq-hero.jpg') }}');
        background-size: cover;
        background-position: center;
        padding: 8rem 0 5rem;
    }
</style>
@endpush

@section('content')

<section class="faq-hero text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block px-4 py-1 gold-gradient text-primary font-semibold text-sm rounded-full mb-4">
            <i class="bi bi-question-circle me-1"></i> Help Center
        </span>
        <h1 class="font-display text-4xl md:text-5xl font-bold leading-tight mb-4">Frequently Asked Questions</h1>
        <p class="text-lg text-gray-300 max-w-2xl mx-auto">Answers to common questions about our legal services.</p>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @forelse ($faqs as $faq)
            <div class="bg-white rounded-xl shadow-sm mb-4 overflow-hidden">
                <button type="button" class="faq-toggle w-full flex items-center justify-between p-6 text-left hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-primary">{{ $faq->question }}</span>
                    <i class="bi bi-chevron-down text-gold transition-transform"></i>
                </button>
                <div class="faq-answer px-6 pb-6 text-gray-600 leading-relaxed hidden">
                    {{ $faq->answer }}
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 py-12">No FAQs available yet. Please contact us for assistance.</p>
        @endforelse

        {{-- CTA --}}
        <div class="mt-12 bg-primary text-white rounded-xl p-8 text-center">
            <h3 class="font-display text-2xl font-bold text-gold mb-3">Still Have Questions?</h3>
            <p class="text-gray-300 mb-6">We're here to help with any legal concerns you may have.</p>
            <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 gold-gradient text-white rounded-lg font-semibold">Contact Us</a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.faq-toggle').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var answer = this.nextElementSibling;
                var icon = this.querySelector('i');
                var isHidden = answer.classList.contains('hidden');
                // Collapse all
                document.querySelectorAll('.faq-answer').forEach(function (a) { a.classList.add('hidden'); });
                document.querySelectorAll('.faq-toggle i').forEach(function (i) { i.classList.remove('rotate-180'); });
                // Expand selected
                if (isHidden) {
                    answer.classList.remove('hidden');
                    icon.classList.add('rotate-180');
                }
            });
        });
    });
</script>
@endpush