<?php

namespace App\Http\Controllers;

use App\Http\Requests\RefereeRequest;
use App\Models\Referee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class refereesController extends Controller
{
    
    public function index()
    {
        $referees = Referee::orderBy('name','asc')->paginate(12);
        return view('referees.index', compact('referees'));
    }

   
    public function create()
    {
        return view('referees.create');
    }

    
    public function store(RefereeRequest $request)
    {
        $refereeData = $request->all();
        if ($image = $request->file('image'))
        {
            $pathSaveImage = 'public/images/referees';
            $image_name = $image->getClientOriginalName().".".$image->getClientOriginalExtension();
            $image->storeAs($pathSaveImage, $image_name);
            $refereeData['image'] = $image_name;
        }

        $referees = Referee::create($refereeData);
        return redirect()->route('referees.index',compact('referees'));
    }

    
    public function show(string $id)
    {
        //
    }

   
    public function edit(Referee $referee)
    {
        return view('referees.edit',compact('referee'));
    }

    
    public function update(RefereeRequest $request, Referee $referee)
    {
        $refereeData = $request->all();
        if ($image = $request->file('image'))
        {
            if ($referee->image)
            {
                Storage::delete('public/images/referees' . $referee->image);
            }

            $pathSaveImage = 'public/images/referees';
            $image_name = $image->getClientOriginalName() . "." . $image->getClientOriginalExtension();
            $image->storeAs($pathSaveImage, $image_name);
            $refereeData['image'] = $image_name;
        } 
        elseif (!isset($referee->image)) 
        {
            $refereeData['image'] = $referee->image;
        }

        $referee->update($refereeData);
        return redirect()->route('referees.index', compact('referee'));
    }

    public function destroy(Referee $referee)
    {
        $referee->delete();
        return redirect()->route('referees.index');
    }
}
