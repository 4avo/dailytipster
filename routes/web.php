<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PredictionController;


Route::get('/store', [StoreController::class, 'index'])->name('store');

Route::get('/', [ProfileController::class, 'index'])->middleware(['auth', 'verified'])->name('welcome');

Route::get('/leaderboard', [ProfileController::class, 'leaderboard'])->name('leaderboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/predictions', [PredictionController::class, 'index'])->name('predictions');
Route::post('/predictions', [PredictionController::class, 'store'])->name('predictions.store');


Route::any('{catchall}', [PageController::class, 'notfound'])->where('catchall', '.*');