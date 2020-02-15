<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Examination;
use App\Doctor;
use App\Http\Controllers\CheckSubuserController;

class ExaminationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('selected');
    }
    public function index()
    {
        //CheckSubuserController::check();
        $subuser_id=session('subuser_id');
        $examinations = Examination::where('subuser_id', '=', session()->get('subuser_id'))->orderBy('date', 'desc')->get();
        return view('examinations.index', compact('examinations', 'subuser_id'));
    }
    public function show($id)
    {
        $examination = Examination::find($id);
        $doctors = Doctor::get(['id', 'name', 'surname'])->pluck('full_name', 'id');
        $subuser_id = session()->get('subuser_id');
        return view('examinations.show', compact('examination', 'doctors', 'subuser_id'));
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
        $examination->date = $request->input('date');
        $examination->photo=$filenameToStore;
        $examination->save();
        return redirect('/dashboard')->with('success', 'Wynik badań dodany');
    }
    public function edit($id)
    {
        $subuser_id = session()->get('subuser_id');
        $examination = Examination::find($id);
        $doctors = Doctor::get(['id', 'name', 'surname'])->pluck('full_name', 'id');
        return view('examinations.edit', compact('examination', 'doctors', 'subuser_id'));
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
              'name' => 'required',
              'doctor' => 'required'
            ],
            [
              'name.required' => 'Pole nazwa badania jest wymagane',
              'doctor_id' => 'Pole lekarz jest wymagane'
            ]
        );
        $examination = Examination::find($id);
        $examination->name = $request->input('name');
        $examination->subuser_id = $request->input('subuser_id');
        $examination->doctor_id = $request->input('doctor');
        $examination->description = $request->input('description');
        $examination->date = $request->input('date');
        if ($request->file('photo')!=null) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('public/examinations/'.$request->session()->get('subuser_id'), $filenameToStore);
            $examination->photo = $filenameToStore;
        }

        $examination->save();
        return redirect()->action('ExaminationsController@index')->with('Success', 'Wynik badań został zaktualizowany');
    }
    public function destroy($id)
    {
        $examination = Examination::find($id);
        $examination->delete();
        return redirect('/examinations');
    }
}
