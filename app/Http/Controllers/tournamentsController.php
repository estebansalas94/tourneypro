<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use Illuminate\Support\Facades\Storage;

class tournamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tournaments = Tournament::orderBy('id', 'desc')->paginate(6);
        return view('tournaments.index', compact('tournaments'));
    }

    public function create()
    {
        return view('tournaments.create');
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
        return redirect()->route('tournaments.index', $Tournament);
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
    public function destroy(Tournament $tournament)
    {
        $tournament->delete();
        return redirect()->route('tournaments.index');
    }
}
