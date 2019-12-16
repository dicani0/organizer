<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Examination;
use App\Doctor;

class ExaminationsController extends Controller
{
    public function index()
    {
        $subuser_id=session('subuser_id');
        $examinations = Examination::all();
        return view('examinations.index', compact('examinations', 'subuser_id'));
    }
    public function create()
    {
        $doctors = Doctor::get(['id', 'name', 'surname'])->pluck('full_name', 'id');
        return view('examinations.create')->with('doctors', $doctors);
    }
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
          'name' => 'required',
          'photo' => 'image|max:1999'
        ],
            [
          'examination.required' => 'Pole nazwa badania jest wymagane'
        ]
        );

        $filenameWithExt = $request->file('photo')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('photo')->storeAs('public/examinations/'.$request->session()->get('subuser_id'), $filenameToStore);

        $examination = new Examination();
        $examination->name = $request->input('name');
        $examination->doctor_id = $request->input('doctor_id');
        $examination->subuser_id = $request->session()->get('subuser_id');
        $examination->description = $request->input('description');
        $examination->photo=$filenameToStore;
        $examination->save();
        return redirect('/dashboard')->with('success', 'Wynik badań dodany');
    }
}
