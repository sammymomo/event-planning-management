<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventCatalogController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Sponsor\DashboardController as SponsorDashboardController;
use App\Http\Controllers\Sponsor\SponsorshipController;
use App\Http\Controllers\Volunteer\AvailabilityController as VolunteerAvailabilityController;
use App\Http\Controllers\Volunteer\ScheduleController as VolunteerScheduleController;
use App\Http\Controllers\Volunteer\TaskController as VolunteerTaskController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Organizer\AttendeeController as OrganizerAttendeeController;
use App\Http\Controllers\Organizer\DashboardController as OrganizerDashboardController;
use App\Http\Controllers\Organizer\EventController as OrganizerEventController;
use App\Http\Controllers\Organizer\FeedbackController as OrganizerFeedbackController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/events', [EventCatalogController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventCatalogController::class, 'show'])->name('events.show');

Route::post('/events/{event}/register', [RegistrationController::class, 'store'])->middleware('auth')->name('events.register');
Route::delete('/events/{event}/register', [RegistrationController::class, 'destroy'])->middleware('auth')->name('events.unregister');
Route::get('/my-registrations', [RegistrationController::class, 'index'])->middleware('auth')->name('member.registrations');
Route::get('/events/{event}/feedback/create', [FeedbackController::class, 'create'])->middleware('auth')->name('events.feedback.create');
Route::post('/events/{event}/feedback', [FeedbackController::class, 'store'])->middleware('auth')->name('events.feedback.store');

Route::get('/notifications', [NotificationController::class, 'index'])->middleware('auth')->name('notifications.index');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:organizer'])->prefix('organizer')->name('organizer.')->group(function () {
    Route::get('/dashboard', [OrganizerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/events/create', [OrganizerEventController::class, 'create'])->name('events.create');
    Route::post('/events', [OrganizerEventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [OrganizerEventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [OrganizerEventController::class, 'update'])->name('events.update');
    Route::post('/events/{event}/tasks', [OrganizerEventController::class, 'storeTask'])->name('events.tasks.store');
    Route::delete('/events/{event}/tasks/{task}', [OrganizerEventController::class, 'destroyTask'])->name('events.tasks.destroy');
    Route::get('/events/{event}/attendees', [OrganizerAttendeeController::class, 'index'])->name('events.attendees');
    Route::get('/events/{event}/attendees/export', [OrganizerAttendeeController::class, 'export'])->name('events.attendees.export');
    Route::get('/events/{event}/feedback', [OrganizerFeedbackController::class, 'index'])->name('events.feedback');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
    Route::patch('/events/{event}/approve', [AdminEventController::class, 'approve'])->name('events.approve');
    Route::patch('/events/{event}/reject', [AdminEventController::class, 'reject'])->name('events.reject');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::patch('/users/{user}/toggle-block', [AdminUserController::class, 'toggleBlock'])->name('users.toggle-block');
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::patch('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
});

Route::middleware(['auth', 'role:volunteer'])->prefix('volunteer')->name('volunteer.')->group(function () {
    Route::get('/tasks', [VolunteerTaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks/{task}/signup', [VolunteerTaskController::class, 'signup'])->name('tasks.signup');
    Route::delete('/tasks/{task}/leave', [VolunteerTaskController::class, 'leave'])->name('tasks.leave');
    Route::get('/schedule', [VolunteerScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/availability', [VolunteerAvailabilityController::class, 'edit'])->name('availability.edit');
    Route::patch('/availability', [VolunteerAvailabilityController::class, 'update'])->name('availability.update');
});

Route::middleware(['auth', 'role:sponsor'])->prefix('sponsor')->name('sponsor.')->group(function () {
    Route::get('/dashboard', [SponsorDashboardController::class, 'index'])->name('dashboard');
    Route::get('/sponsorships/create', [SponsorshipController::class, 'create'])->name('sponsorships.create');
    Route::post('/sponsorships', [SponsorshipController::class, 'store'])->name('sponsorships.store');
    Route::get('/sponsorships/{sponsorship}/acknowledgment', [SponsorshipController::class, 'acknowledgment'])->name('sponsorships.acknowledgment');
    Route::get('/sponsorships/{sponsorship}/report', [SponsorshipController::class, 'report'])->name('sponsorships.report');
});

require __DIR__.'/auth.php';
