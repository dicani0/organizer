<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\Referal;

class ReferalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subuser_id=session('subuser_id');
        $referals = Referal::where('subuser_id', '=', session()->get('subuser_id'))->get();
        return view('referals.index', compact('subuser_id', 'referals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctor::get(['id', 'name', 'surname'])->pluck('full_name', 'id');
        return view('referals.create')->with('doctors', $doctors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
          'name' => 'required',
          'doctor_id_from' => 'required',
          'doctor_id_to' => 'required',
          'photo' => 'required'
        ],
            [
          'name.required' => 'Polę nazwa badania jest wymagane',
          'doctor_id_from.required' => 'Wybranie doktora wystawiającego skierowanie jest wymagane',
          'doctor_id_to.required' => 'Wybranie doktora, do którego jest się skierowanym jest wymagane',
          'photo.required' => 'Dodanie skanu jest wymagane'
        ]
        );
        $filenameWithExt = $request->file('photo')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('photo')->storeAs('public/referals/'.$request->session()->get('subuser_id'), $filenameToStore);

        $referal = new Referal();
        $referal->name = $request->input('name');
        $referal->subuser_id = $request->session()->get('subuser_id');
        $referal->doctor_id_from = $request->input('doctor_id_from');
        $referal->doctor_id_to = $request->input('doctor_id_to');
        $referal->description = $request->input('description');
        $referal->photo = $filenameToStore;
        $referal->save();
        return redirect('referals')->with('success', 'Skierowanie zostało dodane');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $referal = Referal::find($id);
        $doctor = Doctor::get(['id', 'name', 'surname'])->pluck('full_name', 'id');
        $subuser_id = session()->get('subuser_id');
        return view('referals.show', compact('referal', 'doctor', 'subuser_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subuser_id = session()->get('subuser_id');
        $referal = Referal::find($id);
        $doctors = Doctor::get(['id', 'name', 'surname'])->pluck('full_name', 'id');
        return view('referals.edit', compact('referal', 'doctors', 'subuser_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
            'name' => 'required',
            'doctor_from' => 'required',
            'doctor_to' => 'required'
          ],
            [
            'name.required' => 'Pole nazwa badania jest wymagane',
            'doctor_from' => 'Pole lekarz jest wymagane',
            'doctor_to' => 'Pole lekarz jest wymagane'
          ]
        );
        $referal = Referal::find($id);
        $referal->name = $request->input('name');
        $referal->subuser_id = $request->input('subuser_id');
        $referal->doctor_id_from = $request->input('doctor_from');
        $referal->doctor_id_to = $request->input('doctor_to');
        $referal->description = $request->input('description');
        if ($request->file('photo')!=null) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('public/referals/'.$request->session()->get('subuser_id'), $filenameToStore);
            $referal->photo = $filenameToStore;
        }

        $referal->save();
        return redirect()->action('ReferalsController@index')->with('Success', 'Skierowanie zostało zaktualizowane');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $referal = Referal::find($id);
        $referal->delete();
        return redirect('/referals')->with('success', 'Skierowanie zostało usunięte');
    }
}
