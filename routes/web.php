<?php

use App\Enums\SupportStatus;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;


Route::get('/supports', [SupportController::class, 'index'])
    ->name('supports.index');
Route::get('/supports/create', [SupportController::class,'create'])
    ->name('supports.create');
Route::post('/supports', [SupportController::class,'store'])
    ->name('supports.store');

Route::get('/supports/{id}', [SupportController::class,'show'])
    ->name('supports.show');
Route::get('/supports/{id}/edit', [SupportController::class,'edit'])
    ->name('supports.edit');
    
Route::put('/supports/{id}', [SupportController::class,'update'])
    ->name('supports.update');
Route::delete('supports/{id}', [SupportController::class, 'destroy'])
    ->name('supports.destroy');

Route::get('/test', function () {
    dd(array_column(SupportStatus::cases(), 'name'));
        // SupportStatus::cases());
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', [SiteController::class, 'contact'])->name('contact');

Route::get('user', [])->name('user');

// Rotas do Breeze

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

