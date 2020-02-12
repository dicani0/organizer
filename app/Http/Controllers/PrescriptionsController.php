<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prescription;
use App\Doctor;

class PrescriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('selected');
    }
    public function index()
    {
        $subuser_id=session('subuser_id');
        $prescriptions = Prescription::where('subuser_id', '=', session()->get('subuser_id'))->get();
        return view('prescriptions.index', compact('prescriptions', 'subuser_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctor::get(['id', 'name', 'surname'])->pluck('full_name', 'id');
        return view('prescriptions.create')->with('doctors', $doctors);
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
        'photo' => 'image|max:1999'
      ],
            [
        'prescription.required' => 'Pole nazwa badania jest wymagane'
      ]
        );

        $filenameWithExt = $request->file('photo')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('photo')->storeAs('public/prescriptions/'.$request->session()->get('subuser_id'), $filenameToStore);

        $prescription = new prescription();
        $prescription->name = $request->input('name');
        $prescription->doctor_id = $request->input('doctor_id');
        $prescription->subuser_id = $request->session()->get('subuser_id');
        $prescription->medicine = $request->input('medicine');
        $prescription->photo=$filenameToStore;
        $prescription->save();
        return redirect('/dashboard')->with('success', 'Wynik badań dodany');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prescription = prescription::find($id);
        $doctors = Doctor::get(['id', 'name', 'surname'])->pluck('full_name', 'id');
        $subuser_id = session()->get('subuser_id');
        return view('prescriptions.show', compact('prescription', 'doctors', 'subuser_id'));
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
        $prescription = prescription::find($id);
        $doctors = Doctor::get(['id', 'name', 'surname'])->pluck('full_name', 'id');
        return view('prescriptions.edit', compact('prescription', 'doctors', 'subuser_id'));
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
            'doctor' => 'required'
          ],
            [
            'name.required' => 'Pole nazwa badania jest wymagane',
            'doctor_id' => 'Pole lekarz jest wymagane'
          ]
        );
        $prescription = prescription::find($id);
        $prescription->name = $request->input('name');
        $prescription->subuser_id = $request->input('subuser_id');
        $prescription->doctor_id = $request->input('doctor');
        $prescription->medicine = $request->input('medicine');
        if ($request->file('photo')!=null) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('public/prescriptions/'.$request->session()->get('subuser_id'), $filenameToStore);
            $prescription->photo = $filenameToStore;
        }

        $prescription->save();
        return redirect()->action('PrescriptionsController@index')->with('Success', 'Recepta została zaktualizowana');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prescription = prescription::find($id);
        $prescription->delete();
        return redirect('/prescriptions');
    }
}
