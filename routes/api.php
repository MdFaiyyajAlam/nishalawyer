<?php

use App\Http\Controllers\Api\CaseApiController;
use App\Http\Controllers\Api\AppointmentApiController;
use App\Http\Controllers\Api\DocumentApiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    // Cases API
    Route::get('/cases', [CaseApiController::class, 'index']);
    Route::get('/cases/{case}', [CaseApiController::class, 'show']);
    Route::post('/cases', [CaseApiController::class, 'store']);
    Route::put('/cases/{case}', [CaseApiController::class, 'update']);
    Route::delete('/cases/{case}', [CaseApiController::class, 'destroy']);

    // Appointments API
    Route::get('/appointments', [AppointmentApiController::class, 'index']);
    Route::get('/appointments/{appointment}', [AppointmentApiController::class, 'show']);
    Route::post('/appointments', [AppointmentApiController::class, 'store']);
    Route::put('/appointments/{appointment}', [AppointmentApiController::class, 'update']);

    // Documents API
    Route::get('/documents', [DocumentApiController::class, 'index']);
    Route::get('/documents/{document}', [DocumentApiController::class, 'show']);
    Route::post('/documents', [DocumentApiController::class, 'store']);
    Route::get('/documents/{document}/download', [DocumentApiController::class, 'download']);
    Route::delete('/documents/{document}', [DocumentApiController::class, 'destroy']);
});

// Public API endpoints (no auth required)
Route::get('/practice-areas', [\App\Http\Controllers\Api\PublicApiController::class, 'practiceAreas']);
Route::get('/blog/posts', [\App\Http\Controllers\Api\PublicApiController::class, 'blogPosts']);
Route::get('/blog/posts/{slug}', [\App\Http\Controllers\Api\PublicApiController::class, 'blogPost']);
Route::get('/testimonials', [\App\Http\Controllers\Api\PublicApiController::class, 'testimonials']);
Route::get('/faqs', [\App\Http\Controllers\Api\PublicApiController::class, 'faqs']);