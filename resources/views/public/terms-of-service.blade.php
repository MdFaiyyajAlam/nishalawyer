@extends('layouts.app')

@section('title', 'Terms of Service - ' . config('nishalawyer.advocate.name'))
@section('metaDescription', 'Review the terms and conditions for using NishaLawyer website and services.')

@section('content')
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display text-4xl font-bold text-primary mb-6">Terms of Service</h1>
        <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
            <p>These Terms of Service govern your use of the {{ config('nishalawyer.advocate.name') }} website and services.</p>
            <h2 class="font-display text-2xl text-primary mt-8 mb-3">Use of Services</h2>
            <p>You may use our website to inquire about legal services and communicate with our team. Any information you provide is subject to these terms.</p>
            <h2 class="font-display text-2xl text-primary mt-8 mb-3">Appointments & Consultations</h2>
            <p>Consultation appointments are subject to confirmation by our office. We reserve the right to reschedule or cancel appointments when necessary.</p>
            <h2 class="font-display text-2xl text-primary mt-8 mb-3">Confidentiality</h2>
            <p>While we take reasonable steps to protect your information, please note that information shared before an attorney-client relationship is established may not be fully protected under privilege.</p>
            <h2 class="font-display text-2xl text-primary mt-8 mb-3">Changes</h2>
            <p>We may update these terms from time to time. Continued use of the site constitutes acceptance of updated terms.</p>
        </div>
    </div>
</section>
@endsection