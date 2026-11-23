<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminChannelController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminMessageController;
use App\Http\Controllers\Admin\AdminProjectController;
use App\Http\Controllers\Admin\AdminToolController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TransmissionController;
use Illuminate\Support\Facades\Route;

// Public Portfolio & Contact Transmission
Route::get('/', PortfolioController::class)->name('portfolio.index');
Route::post('/transmission', [TransmissionController::class, 'store'])
    ->middleware('throttle:12,1')
    ->name('portfolio.transmission.store');

// Admin Authentication Gate (Triggered from the small diamond under Grey_dev on Home)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.attempt');

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('/', [AdminDashboardController::class, 'index'])->name('index');
        Route::put('/settings', [AdminDashboardController::class, 'updateSettings'])->name('settings.update');
        Route::put('/password', [AdminDashboardController::class, 'updatePassword'])->name('password.update');

        Route::post('/projects', [AdminProjectController::class, 'store'])->name('projects.store');
        Route::put('/projects/{project}', [AdminProjectController::class, 'update'])->name('projects.update');
        Route::delete('/projects/{project}', [AdminProjectController::class, 'destroy'])->name('projects.destroy');
        Route::post('/projects/{project}/move', [AdminProjectController::class, 'move'])->name('projects.move');

        Route::post('/tools', [AdminToolController::class, 'store'])->name('tools.store');
        Route::put('/tools/{tool}', [AdminToolController::class, 'update'])->name('tools.update');
        Route::delete('/tools/{tool}', [AdminToolController::class, 'destroy'])->name('tools.destroy');
        Route::post('/tools/{tool}/move', [AdminToolController::class, 'move'])->name('tools.move');

        Route::post('/channels', [AdminChannelController::class, 'store'])->name('channels.store');
        Route::put('/channels/{channel}', [AdminChannelController::class, 'update'])->name('channels.update');
        Route::delete('/channels/{channel}', [AdminChannelController::class, 'destroy'])->name('channels.destroy');

        Route::patch('/messages/{message}/read', [AdminMessageController::class, 'toggleRead'])->name('messages.toggle-read');
        Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');
    });
});
