<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SportmonksApiController;

Route::get('/', [ProfileController::class, 'index'])->middleware(['auth'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::controller(SportmonksApiController::class)->group(function () {
    Route::get('/leagues', 'leagues');
    Route::get('/leaguesWithCurrentSeason', 'leaguesWithCurrentSeason');
    Route::get('/seasonTeams', 'seasonTeams');
    Route::get('/seasonTeamsWithPlayerNames', 'seasonTeamsWithPlayerNames');
    Route::get('/playerSeasonStatistics', 'playerSeasonStatistics');
    Route::get('/previousPlayerSeasonStatistics', 'previousPlayerSeasonStatistics');
});