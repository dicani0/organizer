<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialization;
use App\Doctor;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors.show')->with('doctors', $doctors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specializations = Specialization::pluck('name', 'id');
        return view('doctors.create', compact('specializations'));
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
                'name'=>'required',
                'surname'=>'required',
                'address'=>'required',
                'phone'=>'required|digits:9',
                'specialization'=>'required',
                'website' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            ],
            [
              'name.required' => 'Pole imię jest wymagane',
              'surname.required' => 'Pole nazwisko jest wymagane',
              'address.required' => 'Pole adres jest wymagane',
              'phone.required' => 'Pole numer telefonu jest wymagane',
              'phone.digits' => 'Pole numer telefonu musi się składać z 9 cyfr',
              'specialization.required' => 'Wybranie specjalizacji jest wymagane',
              'website.regex' => 'Pole strona internetowa musi mieć poprawny format np. (www.google.com).'
              ]
        );
        $doctor = new Doctor();
        $doctor->name=$request->input('name');
        $doctor->surname=$request->input('surname');
        $doctor->address=$request->input('address');
        $doctor->phone=$request->input('phone');
        $doctor->website=$request->input('website');
        $doctor->about=$request->input('about');
        $doctor->spec_id=$request->input('specialization');
        $doctor->save();
        return redirect('/doctors')->with('success', 'Lekarz został dodany');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = Doctor::find($id);
        $specializations = Specialization::pluck('name', 'id');
        return view('doctors.edit', compact('doctor', 'specializations'));
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
              'name'=>'required',
              'surname'=>'required',
              'address'=>'required',
              'phone'=>'required|digits:9',
              'specialization'=>'required',
              'website' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
          ],
            [
            'name.required' => 'Pole imię jest wymagane',
            'surname.required' => 'Pole nazwisko jest wymagane',
            'address.required' => 'Pole adres jest wymagane',
            'phone.required' => 'Pole numer telefonu jest wymagane',
            'phone.digits' => 'Pole numer telefonu musi się składać z 9 cyfr',
            'specialization.required' => 'Wybranie specjalizacji jest wymagane',
            'website.regex' => 'Pole strona internetowa musi mieć poprawny format np. (www.google.com).'
            ]
        );
        $doctor = Doctor::find($id);
        $doctor->name = $request->input('name');
        $doctor->surname = $request->input('surname');
        $doctor->address = $request->input('address');
        $doctor->phone = $request->input('phone');
        $doctor->website = $request->input('website');
        $doctor->about = $request->input('about');
        $doctor->spec_id = $request->input('specialization');
        $doctor->save();
        return redirect('/doctors')->with('success', 'Lekarz został zaktualizowany');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();
        return redirect('doctors')->with('error', 'Lekarz został usunięty');
    }
}
