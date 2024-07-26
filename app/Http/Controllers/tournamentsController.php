<?php

namespace App\Http\Controllers;

use App\Http\Requests\TournamentRequest;
use App\Models\Stadium;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Models\Tournament;
use Illuminate\Support\Facades\Storage;

class tournamentsController extends Controller
{
   
    public function index()
    {
        $tournaments = Tournament::orderBy('id', 'desc')->paginate(6);
        return view('tournaments.index', compact('tournaments'));
    }

    public function create()
    {
        return view('tournaments.create');
    }
    public function teams(Request $request, Tournament $tournament)
    {
        $teams = $tournament->teams;
        return view('tournaments.teams', compact('tournament', 'teams'));
    }


    public function store(TournamentRequest $request)
    {

        $tournament = $request->all();
        if ($image = $request->file('image'))
        {
            $pathSaveImage = 'public\images\tournaments';
            $image_name =  $image->getClientOriginalName().".". $image->getClientOriginalExtension();
            $image->storeAs($pathSaveImage, $image_name);

            $tournament['image'] = $image_name;
        }
        $Tournament = Tournament::create($tournament);

        return redirect()->route('tournaments.show', $Tournament);
    }

    public function show(Tournament $tournament)
    {
        return view('tournaments.show', compact('tournament'));
    }

    public function edit(Tournament $tournament)
    {
        return view('tournaments.edit',compact('tournament'));
    }

    public function update(TournamentRequest $request, Tournament $tournament)
    {
        $data = $request->all();
        if ($image = $request->file('image')) {
            if ($tournament->image) {
                Storage::delete('public/images/tournaments/' . $tournament->image);
            }

            $pathSaveImage = 'public/images/tournaments';
            $image_name = $image->getClientOriginalName() . '_' . $image->getClientOriginalExtension();
            $image->storeAs($pathSaveImage, $image_name);
            $data['image'] = $image_name;
        } elseif (!isset($tournament->image)) {
            $data['image'] = $tournament->image;
        }
        $tournament->update($data);
        return redirect()->route('tournaments.show',$tournament);
    }

    public function destroy(Tournament $tournament)
    {
        $tournament->delete();
        return redirect()->route('tournaments.index');
    }

    public function selectTeams(Tournament $tournament, Request $request)
    {
       
        $assignedTeamIds = $tournament->teams->pluck('id')->toArray();
        $query = $request->input('search');
        $teams = Team::whereNotIn('id', $assignedTeamIds)->orderBy('name', 'asc')
        ->when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'LIKE', "%{$query}%");
        })->get();
        
        return view('tournaments.selectTeams', compact('tournament', 'teams'));
    }

    public function storeSelectedTeams(Request $request, Tournament $tournament)
    {
        $tournament->teams()->syncWithoutDetaching($request->team_ids);
        return redirect()->route('tournaments.teams', $tournament->id);
    }

    public function removeTeam($tournament_id, $team_id)
    {
        $tournament = Tournament::findOrFail($tournament_id);
        $team = Team::findOrFail($team_id);

        // Eliminar la relación en la tabla pivote
        $tournament->teams()->detach($team);

        return redirect()->back()->with('success', 'El equipo ha sido eliminado del torneo.');
    }

    public function matches(Request $request, Tournament $tournament, Team $team)
    {
        $matches = $tournament->matches()
                              ->where('status', 'programado')
                              ->with(['teamLocal', 'teamVisitor'])
                              ->get(); 
        return view('tournaments.matches', compact('tournament','matches'));
    }
    public function matchFinished(Request $request, Tournament $tournament, Team $team)
    {
        $matches = $tournament->matches()
                              ->where('status', 'finalizado')
                              ->with(['teamLocal', 'teamVisitor'])
                              ->get(); 
        return view('tournaments.matchesFinished', compact('tournament','matches'));
    }
}
