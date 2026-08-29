<?php

namespace App\Services;

use App\Models\Testimonial;

class TestimonialService
{
    public function getApprovedTestimonials(int $limit = 10): \Illuminate\Database\Eloquent\Collection
    {
        return Testimonial::where('status', 'approved')
            ->orderByDesc('is_featured')
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    public function getFeaturedTestimonials(int $limit = 6): \Illuminate\Database\Eloquent\Collection
    {
        return Testimonial::where('status', 'approved')
            ->where('is_featured', true)
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    public function approve(Testimonial $testimonial): Testimonial
    {
        return $testimonial->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]) ? $testimonial->fresh() : $testimonial;
    }

    public function reject(Testimonial $testimonial): Testimonial
    {
        $testimonial->update(['status' => 'rejected']);
        return $testimonial->fresh();
    }
}