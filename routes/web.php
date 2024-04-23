<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tournamentsController;
use App\Http\Controllers\teamsController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('tournaments', tournamentsController::class);
    Route::get('tournaments/{tournament}/teams', [TournamentsController::class, 'teams'])->name('tournaments.teams');
    Route::resource('teams', teamsController::class);
});

require __DIR__.'/auth.php';
