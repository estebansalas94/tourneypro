<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Team;
use App\Models\Tournament;
use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class teamsController extends Controller
{
    public function index()
    {
        $teams = Team::orderBy('id', 'desc')->paginate(22);
        return view('teams.index', compact('teams'));
    }
    public function create()
    {
        return view('teams.create');
    }

    public function templates(Request $request, Team $team)
    {
        $templates = $team->templates;

        $ages = [];

        foreach ($templates as $template) {
            $birthdate = $template->birth_date_at;
            $age = Carbon::parse($birthdate)->age;
            $ages[] = $age;
        }
        return view('teams.template', compact('team','templates','ages'));
    }

    public function stadiums(Request $request, Team $team)
    {
        $stadium = $team->stadium;
        return view('teams.stadium', compact('team','stadium'));
    }

    public function store(TeamRequest $request)
    {
        $team = $request->all();
        if ($shield = $request->file('shield'))
        {
            $pathSaveImage = 'public\images\teams';
            $image_name =  $shield->getClientOriginalName().".". $shield->getClientOriginalExtension();
            $shield->storeAs($pathSaveImage, $image_name);

            $team['shield'] = $image_name;
        }

        $Team = Team::create($team);
        return redirect()->route('teams.show', $Team);
    }

    public function show(Team $team)
    {
        return view('teams.show', compact('team'));
    }

    public function edit(Team $team)
    {
        return view('teams.edit',compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $data = $request->all();
        if ($shield = $request->file('shield')) {
            if ($team->shield) {
                Storage::delete('public/images/teams/' . $team->shield);
            }

            $pathSaveImage = 'public/images/teams';
            $image_name = $shield->getClientOriginalName() . '.' . $shield->getClientOriginalExtension();
            $shield->storeAs($pathSaveImage, $image_name);
            $data['shield'] = $image_name;
        } elseif (!isset($team->shield)) {
            $data['shield'] = $team->shield;
        }
        $team->update($data);
        return redirect()->route('teams.show',$team);
    }

    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('teams.index');
    }
}
