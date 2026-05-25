<?php

use App\Http\Controllers\EventCatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Organizer\AttendeeController as OrganizerAttendeeController;
use App\Http\Controllers\Organizer\DashboardController as OrganizerDashboardController;
use App\Http\Controllers\Organizer\EventController as OrganizerEventController;
use App\Http\Controllers\Organizer\FeedbackController as OrganizerFeedbackController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/events', [EventCatalogController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventCatalogController::class, 'show'])->name('events.show');

// Placeholder — replaced in C27
Route::post('/events/{event}/register', fn () => back())->middleware('auth')->name('events.register');

// Placeholder — replaced in C40
Route::get('/notifications', fn () => redirect('/'))->name('notifications.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
    // Placeholders — replaced in C24/C25/C26
    Route::get('/users', fn () => redirect('/admin/events'))->name('users.index');
    Route::get('/reports', fn () => redirect('/admin/events'))->name('reports.index');
    Route::get('/settings', fn () => redirect('/admin/events'))->name('settings.index');
});

Route::middleware(['auth', 'role:volunteer'])->prefix('volunteer')->name('volunteer.')->group(function () {
    Route::get('/tasks', fn () => redirect('/'))->name('tasks.index');
});

Route::middleware(['auth', 'role:sponsor'])->prefix('sponsor')->name('sponsor.')->group(function () {
    Route::get('/dashboard', fn () => redirect('/'))->name('dashboard');
});

require __DIR__.'/auth.php';
