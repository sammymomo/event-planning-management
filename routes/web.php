<?php

use App\Http\Controllers\EventCatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Organizer\DashboardController as OrganizerDashboardController;
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
    // Placeholders — replaced in C19/C20/C21/C22
    Route::get('/events/create', fn () => redirect('/organizer/dashboard'))->name('events.create');
    Route::get('/events/{event}/edit', fn () => redirect('/organizer/dashboard'))->name('events.edit');
    Route::get('/events/{event}/attendees', fn () => redirect('/organizer/dashboard'))->name('events.attendees');
    Route::get('/events/{event}/feedback', fn () => redirect('/organizer/dashboard'))->name('events.feedback');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/events', fn () => redirect('/'))->name('events.index');
});

Route::middleware(['auth', 'role:volunteer'])->prefix('volunteer')->name('volunteer.')->group(function () {
    Route::get('/tasks', fn () => redirect('/'))->name('tasks.index');
});

Route::middleware(['auth', 'role:sponsor'])->prefix('sponsor')->name('sponsor.')->group(function () {
    Route::get('/dashboard', fn () => redirect('/'))->name('dashboard');
});

require __DIR__.'/auth.php';
