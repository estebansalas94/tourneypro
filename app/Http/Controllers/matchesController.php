<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchRequest;
use App\Models\Game;
use App\Models\Referee;
use App\Models\Tournament;
use Illuminate\Http\Request;

class matchesController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        
    }

    public function created(Tournament $tournament)
    {
        $teams = $tournament->teams;
        $referee = Referee::all();
        return view('matches.create', compact('tournament','teams','referee'));
    }

    public function store(Request $request, Tournament $tournament)
    {
        $refereeIds = $request->input('referee_id');
        $match = Game::create([
            'date_at' => $request->date_at,
            'description' => $request->description,
            'goal_local' => $request->goal_local,
            'goal_visitor' => $request->goal_visitor,
            'team_local_id' => $request->team_local_id,
            'team_visitor_id' => $request->team_visitor_id,
            'stadium_id' => $request->stadium_id,
            'tournament_id' => $request->tournament_id
        ]);
        $match->referees()->attach($refereeIds);

      

        return redirect()->route('tournaments.matches', ['tournament' => $match->tournament_id]);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
    
}
