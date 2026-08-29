<?php

use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\AppointmentController;
use App\Http\Controllers\Client\CaseController;
use App\Http\Controllers\Client\DocumentController;
use App\Http\Controllers\Client\NotificationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:client'])->name('client.')->group(function () {
    // Dashboard
    Route::get('/client/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/client/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/client/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/client/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // Appointments
    Route::get('/client/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/client/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/client/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/client/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::patch('/client/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');

    // Cases
    Route::get('/client/cases', [CaseController::class, 'index'])->name('cases.index');
    Route::get('/client/cases/{case}', [CaseController::class, 'show'])->name('cases.show');
    Route::get('/client/cases/{case}/documents', [CaseController::class, 'documents'])->name('cases.documents');

    // Documents
    Route::get('/client/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/client/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/client/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/client/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::patch('/client/documents/{document}/share', [DocumentController::class, 'share'])->name('documents.share');
    Route::delete('/client/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');

    // Notifications
    Route::get('/client/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/client/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
});