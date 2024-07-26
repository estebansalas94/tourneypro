<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchRequest;
use App\Models\Card;
use App\Models\Game;
use App\Models\Goal;
use App\Models\Referee;
use App\Models\Team;
use App\Models\Tournament;
use Hamcrest\Core\AllOf;
use Illuminate\Http\Request;

use function PHPUnit\Framework\matches;

class matchesController extends Controller
{
    public function index()
    {
        $matches = Game::orderBy('date_at', 'asc')
                        ->where('status','programado')
                        ->paginate(9);
        return view('matches.index', compact('matches'));
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

    public function show(Game $match)
    {
        $mainReferee = $match->mainReferee();
        return view('matches.show', compact('match','mainReferee'));
    }

    public function edit(Game $match)
    {
        $mainReferee = $match->mainReferee();
        return view('matches.edit', compact('match','mainReferee'));    }

    public function update(Request $request, Game $match)
    {
        $match->goal_local = $request->goal_local;
        $match->goal_visitor = $request->goal_visitor;
        $match->status = 'finalizado';
        $match->save();
        
        //GUARDAR GOLES
        foreach ($request->goals_local as $player_id => $goals) {
            for ($i = 0; $i < $goals; $i++) {
                Goal::create([
                    'match_id' => $match->id,
                    'player_id' => $player_id,
                    'team_id' => $match->team_local_id,
                ]);
            }
        }

        foreach ($request->goals_visitor as $player_id => $goals) {
            for ($i = 0; $i < $goals; $i++) {
                Goal::create([
                    'match_id' => $match->id,
                    'player_id' => $player_id,
                    'team_id' => $match->team_visitor_id,
                ]);
            }
        }

        //GUARDAR TARJETAS
        foreach ($request->yellow_cards_local as $player_id => $cards) {
            for ($i = 0; $i < $cards; $i++) {
                Card::create([
                    'match_id' => $match->id,
                    'player_id' => $player_id,
                    'team_id' => $match->team_local_id,
                    'color' => 'yellow'
                ]);
            }
        }

        foreach ($request->yellow_cards_visitor as $player_id => $cards) {
            for ($i = 0; $i < $cards; $i++) {
                Card::create([
                    'match_id' => $match->id,
                    'player_id' => $player_id,
                    'team_id' => $match->team_visitor_id,
                    'color' => 'yellow'
                ]);
            }
        }

        foreach ($request->red_cards_local as $player_id => $cards) {
            for ($i = 0; $i < $cards; $i++) {
                Card::create([
                    'match_id' => $match->id,
                    'player_id' => $player_id,
                    'team_id' => $match->team_local_id,
                    'color' => 'red'
                ]);
            }
        }

        foreach ($request->red_cards_visitor as $player_id => $cards) {
            for ($i = 0; $i < $cards; $i++) {
                Card::create([
                    'match_id' => $match->id,
                    'player_id' => $player_id,
                    'team_id' => $match->team_visitor_id,
                    'color' => 'red'
                ]);
            }
        }

        return redirect()->route('matches.finished', $match->id)->with('success','Partido actualizado exitosamente');
    }

    public function finished(Game $match)
    {
        $mainReferee = $match->mainReferee();
        return view('matches.finished', compact('match','mainReferee'));
    }

    public function indexFinished()
    {
        $matches = Game::orderBy('date_at', 'asc')->where('status', 'finalizado')->paginate(9);
        return view('matches.indexFinished', compact('matches'));
    }

    public function destroy(Game $match)
    {
        $match->delete();
        return redirect()->route('matches.matchesfinished');
    }


    
}
