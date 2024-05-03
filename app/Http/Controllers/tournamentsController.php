<?php

namespace App\Http\Controllers;

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


    public function store(Request $request): \Illuminate\Http\RedirectResponse
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

    public function update(Request $request, Tournament $tournament)
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

    public function selectTeams(Tournament $tournament)
    {
        $teams = Team::all();
        return view('tournaments.selectTeams', compact('tournament', 'teams'));
    }

    public function storeSelectedTeams(Request $request, Tournament $tournament)
    {
        $tournament->teams()->sync($request->team_ids);
        return redirect()->route('tournaments.teams', $tournament->id);
    }
}
