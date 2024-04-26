<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tournamentsController;
use App\Http\Controllers\teamsController;
use App\Http\Controllers\templatesController;

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
    Route::get('tournaments/{tournament}/teams', [tournamentsController::class, 'teams'])->name('tournaments.teams');
    Route::get('/tournaments/{tournament}/select-teams', [tournamentsController::class,'selectTeams'])->name('tournaments.select-teams');
    Route::post('/tournaments/{tournament}/select-teams', [tournamentsController::class,'storeSelectedTeams'])->name('tournaments.store-selected-teams');

    Route::resource('teams', teamsController::class);
    Route::get('teams/{team}/templates', [teamsController::class, 'templates'])->name('teams.template');
    Route::get('teams/{team}/templates/created', [templatesController::class, 'created'])->name('templates.created');


    Route::resource('templates', templatesController::class);


});

require __DIR__.'/auth.php';
