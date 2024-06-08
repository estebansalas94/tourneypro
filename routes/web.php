<?php

use App\Http\Controllers\matchesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\refereesController;
use App\Http\Controllers\stadiumsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tournamentsController;
use App\Http\Controllers\teamsController;
use App\Http\Controllers\templatesController;

Route::get('/', function () {
    return view('auth.login');
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
    Route::delete('/tournaments/{tournamentId}/teams/{teamId}', [tournamentsController::class, 'removeTeam'])->name('tournaments.removeTeam');
    Route::get('tournaments/{tournament}/matches', [tournamentsController::class, 'matches'])->name('tournaments.matches');
    Route::get('tournaments/{tournament}/matchesfinished', [tournamentsController::class, 'matchFinished'])->name('tournaments.match-finished');


    Route::resource('teams', teamsController::class);
    Route::get('teams/{team}/templates', [teamsController::class, 'templates'])->name('teams.template');
    Route::get('teams/{team}/templates/created', [templatesController::class, 'created'])->name('templates.created');
    Route::get('teams/{team}/stadiums', [teamsController::class, 'stadiums'])->name('teams.stadium');
    Route::get('teams/{team}/stadiums/created', [stadiumsController::class, 'created'])->name('stadiums.created');


    Route::resource('templates', templatesController::class);
    Route::resource('stadiums', stadiumsController::class);

    Route::resource('referees', refereesController::class);

    Route::resource('matches', matchesController::class);
    Route::get('tournaments/{tournament}/matches/create', [matchesController::class, 'created'])->name('matches.created');



});

require __DIR__.'/auth.php';
