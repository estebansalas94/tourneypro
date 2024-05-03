<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use Illuminate\Http\Request;

class stadiumsController extends Controller
{
    public function index()
    {
        return view('stadiums.index');
    }

    public function created($team)
    {
        $team_id = $team;
        return view('stadiums.create', compact('team_id'));
    }

    public function store(Request $request)
    {
        $stadiumData = $request->all();

        if ($image = $request->file('image'))
        {
            $pathSaveImage = 'public/images/stadiums';
            $image_name = $image->getClientOriginalName() . "." . $image->getClientOriginalExtension();
            $image->storeAs($pathSaveImage, $image_name);
            $stadiumData['image'] = $image_name;
        }

        $stadium = Stadium::create($stadiumData);
        return redirect()->route('teams.stadium', ['team' => $stadium->team_id]);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Stadium $stadium)
    {
        return view('stadiums.edit', compact('stadium'));
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
