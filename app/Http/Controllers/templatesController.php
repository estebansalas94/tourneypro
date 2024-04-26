<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;


class templatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('templates.index');
    }


    public function created($team)
    {
        $team_id = $team;
        return view('templates.create', compact('team_id'));
    }
    public function store(Request $request)
    {
        $templateData = $request->all();

        if ($image = $request->file('image'))
        {
            $pathSaveImage = 'public\images\templates';
            $image_name =  $image->getClientOriginalName().".". $image->getClientOriginalExtension();
            $image->storeAs($pathSaveImage, $image_name);
            $templateData['image'] = $image_name;
        }

        $template = Template::create($templateData);

        return redirect()->route('teams.template', ['team' => $template->team_id]);
    }


    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Template $template)
    {
        return view('templates.edit', compact('template'));
    }

    public function update(Request $request, Template $template)
    {
        $data = $request->all();
        if ($image = $request->file('image')) {
            if ($template->image) {
                Storage::delete('public\images\templates' . $template->image);
            }

            $pathSaveImage = 'public\images\templates';
            $image_name = time() . '_' . $image->getClientOriginalName();
            $image->storeAs($pathSaveImage, $image_name);
            $data['image'] = $image_name;
        } elseif (!isset($template->image)) {
            $data['image'] = $template->image;
        }

        $template->update($data);
        return redirect()->route('teams.template', ['team' => $template->team_id]);
    }


    public function destroy(Template $template)
    {
        $template->delete();
        return redirect()->route('teams.template',['team' => $template->team_id]);
    }
}
