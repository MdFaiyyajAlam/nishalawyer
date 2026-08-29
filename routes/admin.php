<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\CaseController as AdminCaseController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PracticeAreaController;
use App\Http\Controllers\Admin\LegalNoticeController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ReportController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin,advocate'])->name('admin.')->group(function () {
    // Dashboard
    Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->middleware('role:admin')->name('users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->middleware('role:admin')->name('users.store');
    Route::get('/admin/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->middleware('role:admin')->name('users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->middleware('role:admin')->name('users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->middleware('role:admin')->name('users.destroy');
    Route::patch('/admin/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->middleware('role:admin')->name('users.toggle-status');

    // Roles
    Route::get('/admin/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/admin/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/admin/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/admin/roles/{role}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('/admin/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/admin/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/admin/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // Cases
    Route::get('/admin/cases', [AdminCaseController::class, 'index'])->name('cases.index');
    Route::get('/admin/cases/create', [AdminCaseController::class, 'create'])->name('cases.create');
    Route::post('/admin/cases', [AdminCaseController::class, 'store'])->name('cases.store');
    Route::get('/admin/cases/{case}', [AdminCaseController::class, 'show'])->name('cases.show');
    Route::get('/admin/cases/{case}/edit', [AdminCaseController::class, 'edit'])->name('cases.edit');
    Route::put('/admin/cases/{case}', [AdminCaseController::class, 'update'])->name('cases.update');
    Route::delete('/admin/cases/{case}', [AdminCaseController::class, 'destroy'])->name('cases.destroy');
    Route::patch('/admin/cases/{case}/close', [AdminCaseController::class, 'close'])->name('cases.close');

    // Appointments
    Route::get('/admin/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/admin/appointments/calendar', [AppointmentController::class, 'calendar'])->name('appointments.calendar');
    Route::get('/admin/appointments/slots', [AppointmentController::class, 'slots'])->name('appointments.slots');
    Route::get('/admin/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::put('/admin/appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.update-status');

    // Blog
    Route::get('/admin/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/admin/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/admin/blog', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/admin/blog/{blogPost}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/admin/blog/{blogPost}/edit', [BlogController::class, 'edit'])->name('blog.edit');
    Route::put('/admin/blog/{blogPost}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/admin/blog/{blogPost}', [BlogController::class, 'destroy'])->name('blog.destroy');

    // Testimonials
    Route::get('/admin/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('/admin/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('/admin/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
    Route::get('/admin/testimonials/{testimonial}', [TestimonialController::class, 'show'])->name('testimonials.show');
    Route::get('/admin/testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
    Route::put('/admin/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
    Route::patch('/admin/testimonials/{testimonial}/approve', [TestimonialController::class, 'approve'])->name('testimonials.approve');
    Route::patch('/admin/testimonials/{testimonial}/reject', [TestimonialController::class, 'reject'])->name('testimonials.reject');
    Route::delete('/admin/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    // Contacts
    Route::get('/admin/contacts', [ContactController::class, 'contacts'])->name('contacts.index');
    Route::get('/admin/contacts/{contact}', [ContactController::class, 'showContact'])->name('contacts.show');
    Route::put('/admin/contacts/{contact}/reply', [ContactController::class, 'replyContact'])->name('contacts.reply');
    Route::delete('/admin/contacts/{contact}', [ContactController::class, 'destroyContact'])->name('contacts.destroy');

    // Consultation Requests
    Route::get('/admin/consultation-requests', [ContactController::class, 'consultationRequests'])->name('consultations.index');
    Route::get('/admin/consultation-requests/{request}', [ContactController::class, 'showConsultation'])->name('consultations.show');
    Route::put('/admin/consultation-requests/{request}', [ContactController::class, 'updateConsultation'])->name('consultations.update');

    // Settings
    Route::get('/admin/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/admin/settings/{setting}/edit', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/admin/settings/{setting}', [SettingController::class, 'update'])->name('settings.update');
    Route::put('/admin/settings/bulk-update', [SettingController::class, 'bulkUpdate'])->name('settings.bulk-update');

    // Pages
    Route::get('/admin/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/admin/pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::post('/admin/pages', [PageController::class, 'store'])->name('pages.store');
    Route::get('/admin/pages/{page}', [PageController::class, 'show'])->name('pages.show');
    Route::get('/admin/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('/admin/pages/{page}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('/admin/pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');

    // Practice Areas
    Route::get('/admin/practice-areas', [PracticeAreaController::class, 'index'])->name('practice-areas.index');
    Route::get('/admin/practice-areas/create', [PracticeAreaController::class, 'create'])->name('practice-areas.create');
    Route::post('/admin/practice-areas', [PracticeAreaController::class, 'store'])->name('practice-areas.store');
    Route::get('/admin/practice-areas/{practiceArea}', [PracticeAreaController::class, 'show'])->name('practice-areas.show');
    Route::get('/admin/practice-areas/{practiceArea}/edit', [PracticeAreaController::class, 'edit'])->name('practice-areas.edit');
    Route::put('/admin/practice-areas/{practiceArea}', [PracticeAreaController::class, 'update'])->name('practice-areas.update');
    Route::delete('/admin/practice-areas/{practiceArea}', [PracticeAreaController::class, 'destroy'])->name('practice-areas.destroy');

    // Legal Notices
    Route::get('/admin/legal-notices', [LegalNoticeController::class, 'index'])->name('legal-notices.index');
    Route::get('/admin/legal-notices/create', [LegalNoticeController::class, 'create'])->name('legal-notices.create');
    Route::post('/admin/legal-notices', [LegalNoticeController::class, 'store'])->name('legal-notices.store');
    Route::get('/admin/legal-notices/{legalNotice}', [LegalNoticeController::class, 'show'])->name('legal-notices.show');
    Route::delete('/admin/legal-notices/{legalNotice}', [LegalNoticeController::class, 'destroy'])->name('legal-notices.destroy');

    // Documents
    Route::get('/admin/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/admin/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/admin/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/admin/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
    Route::get('/admin/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::delete('/admin/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');

    // FAQs
    Route::get('/admin/faqs', [FaqController::class, 'index'])->name('faqs.index');
    Route::get('/admin/faqs/create', [FaqController::class, 'create'])->name('faqs.create');
    Route::post('/admin/faqs', [FaqController::class, 'store'])->name('faqs.store');
    Route::get('/admin/faqs/{faq}/edit', [FaqController::class, 'edit'])->name('faqs.edit');
    Route::put('/admin/faqs/{faq}', [FaqController::class, 'update'])->name('faqs.update');
    Route::delete('/admin/faqs/{faq}', [FaqController::class, 'destroy'])->name('faqs.destroy');

    // Reports
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/admin/reports/cases', [ReportController::class, 'cases'])->name('reports.cases');
    Route::get('/admin/reports/appointments', [ReportController::class, 'appointments'])->name('reports.appointments');
    Route::get('/admin/reports/revenue', [ReportController::class, 'revenue'])->name('reports.revenue');
});
