@extends('layouts.app')

@section('title', 'Privacy Policy - ' . config('nishalawyer.advocate.name'))
@section('metaDescription', 'Understand how NishaLawyer collects, uses and protects your personal information.')

@section('content')
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display text-4xl font-bold text-primary mb-6">Privacy Policy</h1>
        <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
            <p>This Privacy Policy describes how {{ config('nishalawyer.advocate.name') }} collects, uses, and protects your personal information.</p>
            <h2 class="font-display text-2xl text-primary mt-8 mb-3">Information We Collect</h2>
            <p>We collect information you provide directly, including your name, email address, phone number, and any details included in communications with us.</p>
            <h2 class="font-display text-2xl text-primary mt-8 mb-3">How We Use Your Information</h2>
            <p>We use your information to provide legal services, respond to inquiries, schedule appointments, and improve our service quality. We never sell your personal data.</p>
            <h2 class="font-display text-2xl text-primary mt-8 mb-3">Data Security</h2>
            <p>We implement appropriate technical and organizational measures to protect your information against unauthorized access or disclosure.</p>
            <h2 class="font-display text-2xl text-primary mt-8 mb-3">Contact</h2>
            <p>For any privacy-related questions, contact us at {{ config('nishalawyer.contact.email') }}.</p>
        </div>
    </div>
</section>
@endsection