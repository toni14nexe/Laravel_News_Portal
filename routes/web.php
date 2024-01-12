<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard', ['category' => '']);
});

Route::get('/dashboard', function () {
    return view('dashboard', ['category' => '']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/business', function () {
    return view('dashboard', ['category' => 'business']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/entertainment', function () {
    return view('dashboard', ['category' => 'entertainment']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/general', function () {
    return view('dashboard', ['category' => 'general']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/health', function () {
    return view('dashboard', ['category' => 'health']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/science', function () {
    return view('dashboard', ['category' => 'science']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sports', function () {
    return view('dashboard', ['category' => 'sports']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/technology', function () {
    return view('dashboard', ['category' => 'technology']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
