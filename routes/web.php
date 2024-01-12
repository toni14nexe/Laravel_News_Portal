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
    return view('dashboard', ['category' => '', 'title' => 'Dashboard']);
});

Route::get('/dashboard', function () {
    return view('dashboard', ['category' => '', 'title' => 'Dashboard']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/business', function () {
    return view('dashboard', ['category' => 'business', 'title' => 'Business']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/entertainment', function () {
    return view('dashboard', ['category' => 'entertainment', 'title' => 'Entertainment']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/general', function () {
    return view('dashboard', ['category' => 'general', 'title' => 'General']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/health', function () {
    return view('dashboard', ['category' => 'health', 'title' => 'Health']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/science', function () {
    return view('dashboard', ['category' => 'science', 'title' => 'Science']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sports', function () {
    return view('dashboard', ['category' => 'sports', 'title' => 'Sports']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/technology', function () {
    return view('dashboard', ['category' => 'technology', 'title' => 'Technology']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/search', function () {
    return view('dashboard', ['category' => '', 'title' => 'Search']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
