<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestApiController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //REST API routes
    Route::get('home', [RestApiController::class, 'index'])->name('home');
    Route::get('edit/{id}', [RestApiController::class, 'edit'])->name('edit');
    Route::get('update/{id}', [RestApiController::class, 'update'])->name('update');
    Route::get('destroy/{id}', [RestApiController::class, 'destroy'])->name('destroy');

});

require __DIR__.'/auth.php';
