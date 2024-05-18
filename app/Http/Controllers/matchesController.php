<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Referee;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;

class matchesController extends Controller
{
    public function index()
    {
        //
    }

    public function create(/*Tournament $tournament*/)
    {
        // $teams = $tournament->teams;
        // dd($teams);
        // $referee = Referee::all();
        // return view('matches.create', compact('tournament','teams','referee'));
    }

    public function created(Tournament $tournament)
    {
        $teams = $tournament->teams;
        $referee = Referee::all();
        return view('matches.create', compact('tournament','teams','referee'));
    }

    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
}
