<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ShortUrlController;

Route::get('/', function () {
    return redirect('login');
});

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('invitations/create', [InvitationController::class, 'create'])->name('invitations.create');
    Route::post('invitations', [InvitationController::class, 'store'])->name('invitations.store');

    Route::get('short_urls', [ShortUrlController::class, 'index'])->name('short_urls.index');
    Route::get('short_urls/create', [ShortUrlController::class, 'create'])->name('short_urls.create');
    Route::post('short_urls', [ShortUrlController::class, 'store'])->name('short_urls.store');
    
});

Route::get('{short_code}', [ShortUrlController::class, 'redirect'])->name('short_urls.redirect');
