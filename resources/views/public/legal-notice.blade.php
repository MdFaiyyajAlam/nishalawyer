@extends('layouts.app')

@section('title', 'Legal Notice - ' . config('nishalawyer.advocate.name'))
@section('metaDescription', 'Legal notice and terms governing the use of NishaLawyer website.')

@section('content')
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display text-4xl font-bold text-primary mb-6">Legal Notice</h1>
        <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
            <p>This website is operated by {{ config('nishalawyer.advocate.name') }} ("we", "us", or "our"). By accessing or using this website, you agree to be bound by these terms.</p>
            <h2 class="font-display text-2xl text-primary mt-8 mb-3">Intellectual Property</h2>
            <p>All content on this site is the property of {{ config('nishalawyer.advocate.name') }} and protected by copyright and other intellectual property laws.</p>
            <h2 class="font-display text-2xl text-primary mt-8 mb-3">No Attorney-Client Relationship</h2>
            <p>Information on this website does not constitute legal advice and does not create an attorney-client relationship. You should consult a qualified lawyer for advice specific to your situation.</p>
            <h2 class="font-display text-2xl text-primary mt-8 mb-3">Liability</h2>
            <p>We are not liable for any loss or damage arising from use of this website or reliance on its content.</p>
        </div>
    </div>
</section>
@endsection