<?php

return [

    /*
    |--------------------------------------------------------------------------
    | NishaLawyer Application Configuration
    |--------------------------------------------------------------------------
    |
    | Custom configuration for the NishaLawyer legal application.
    |
    */

    'advocate' => [
        'name' => env('ADVOCATE_NAME', 'Advocate Nisha'),
        'email' => env('ADVOCATE_EMAIL', 'nisha@nivalawyer.com'),
        'phone' => env('ADVOCATE_PHONE', '+91-98765-43210'),
        'address' => env('ADVOCATE_ADDRESS', '123 Legal Chambers, High Court Road, Mumbai - 400001'),
        'bar_number' => env('ADVOCATE_BAR_NUMBER', 'BA-12345'),
        'bio' => 'A passionate advocate with over 15 years of experience in various fields of law, dedicated to providing the best legal counsel and representation to clients.',
        'qualifications' => [
            'LL.B., University of Mumbai',
            'LL.M. (Specialization in Corporate Law), Harvard Law School',
            'Bar Council of India, Member',
        ],
        'years_experience' => 15,
        'cases_won' => 420,
        'clients_served' => 180,
        'success_rate' => '96%',
    ],

    'social' => [
        'facebook' => env('SOCIAL_FACEBOOK', 'https://facebook.com/nivalawyer'),
        'twitter' => env('SOCIAL_TWITTER', 'https://twitter.com/nivalawyer'),
        'linkedin' => env('SOCIAL_LINKEDIN', 'https://linkedin.com/company/nivalawyer'),
        'instagram' => env('SOCIAL_INSTAGRAM', '#'),
    ],

    'contact' => [
        'email' => env('ADVOCATE_EMAIL', 'nisha@nivalawyer.com'),
        'phone' => env('ADVOCATE_PHONE', '+91-98765-43210'),
        'address' => env('ADVOCATE_ADDRESS', '123 Legal Chambers, High Court Road, Mumbai - 400001'),
        'business_hours' => 'Mon-Fri: 9:00 AM - 6:00 PM',
    ],

    'colors' => [
        'primary' => '#0A192F',   // Dark Blue
        'secondary' => '#C5A16E',  // Gold
        'accent' => '#172A45',
        'light' => '#F8F9FA',
        'dark' => '#0A192F',
    ],

    'appointment' => [
        'slot_duration' => 60, // minutes
        'available_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'],
        'start_time' => '09:00',
        'end_time' => '18:00',
    ],

    'document' => [
        'allowed_types' => ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png', 'gif'],
        'max_size' => 10240, // KB (10 MB)
        'storage_disk' => 'local',
    ],

];