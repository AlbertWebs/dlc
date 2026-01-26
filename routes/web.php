<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\NavigationController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\HeroBannerController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\CoachController as AdminCoachController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Admin\FullWidthVideoController;
use App\Http\Controllers\Admin\WhoWeAreController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\AboutPageController;

// Frontend Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/events', [PageController::class, 'events'])->name('events');
Route::get('/become-a-coach', [PageController::class, 'becomeACoach'])->name('become-a-coach');
Route::match(['get', 'post'], '/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/programs', [PageController::class, 'programs'])->name('programs.index');
Route::get('/programs/{slug}', [PageController::class, 'showProgram'])->name('programs.show');
Route::get('/coach/{slug}', [\App\Http\Controllers\CoachController::class, 'show'])->name('coach.show');
Route::get('/videos', [\App\Http\Controllers\VideoController::class, 'index'])->name('videos.index');

// Admin Routes
// TODO: Add 'auth' middleware after installing Laravel Breeze/Jetstream
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::resource('pages', AdminPageController::class);
    Route::resource('navigations', NavigationController::class);
    Route::resource('programs', AdminProgramController::class);
    Route::resource('team', TeamController::class);
    Route::resource('events', EventController::class);
    Route::resource('hero-banners', HeroBannerController::class);
    Route::resource('coaches', AdminCoachController::class);
    Route::resource('videos', AdminVideoController::class);
    Route::resource('testimonials', TestimonialController::class);
    
    // Full Width Video Management
    Route::get('/full-width-video', [FullWidthVideoController::class, 'index'])->name('full-width-video.index');
    Route::put('/full-width-video', [FullWidthVideoController::class, 'update'])->name('full-width-video.update');
    
    // Who We Are Section Management
    Route::get('/who-we-are', [WhoWeAreController::class, 'index'])->name('who-we-are.index');
    Route::put('/who-we-are', [WhoWeAreController::class, 'update'])->name('who-we-are.update');
    Route::get('/about-page', [AboutPageController::class, 'index'])->name('about-page.index');
    Route::put('/about-page', [AboutPageController::class, 'update'])->name('about-page.update');
    
    // Admin Utility Routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'store'])->name('settings.store');
    
    Route::match(['get', 'post'], '/backup', function () {
        if (request()->isMethod('post')) {
            // TODO: Implement backup functionality
            return redirect()->route('admin.backup')->with('backup_success', 'Backup completed successfully!');
        }
        return view('admin.backup');
    })->name('backup');
    
    Route::post('/logout', function () {
        // TODO: Implement logout when auth is set up
        return redirect()->route('home')->with('success', 'Logged out successfully!');
    })->name('logout');
    
    Route::get('/danger-zone', function () {
        return view('admin.danger-zone');
    })->name('danger-zone');
    
    Route::post('/danger-zone/purge', function () {
        // TODO: Implement purge functionality with confirmation
        $request = request();
        if ($request->confirm_text === 'DELETE') {
            // Implement actual purge logic here
            return redirect()->route('admin.dashboard')->with('success', 'Data purged successfully!');
        }
        return redirect()->route('admin.danger-zone')->with('error', 'Confirmation text did not match.');
    })->name('danger-zone.purge');
    
    Route::post('/danger-zone/reset-navigation', function () {
        // TODO: Implement navigation reset
        return redirect()->route('admin.navigations.index')->with('success', 'Navigation reset to defaults!');
    })->name('danger-zone.reset-navigation');
});

// Auth routes (install Laravel Breeze/Jetstream for authentication)
// require __DIR__.'/auth.php';
