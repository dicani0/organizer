<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecommendationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recommendations = Recommendation::all();
        return view('recommendations.index')->with('recommendations', $recommendations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctor::get(['id', 'name', 'surname'])->pluck('full_name', 'id');
        return view('recommendations.create')->with('doctors', $doctors);
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
        $path = $request->file('photo')->storeAs('public/recommendations/'.$request->session()->get('subuser_id'), $filenameToStore);

        $recommendation = new Recommendation();
        $recommendation->name = $request->input('name');
        $recommendation->subuser_id = $request->session()->get('subuser_id');
        $recommendation->doctor_id_from = $request->input('doctor_id_from');
        $recommendation->doctor_id_to = $request->input('doctor_id_to');
        $recommendation->description = $request->input('description');
        $recommendation->photo = $filenameToStore;
        $recommendation->save();
        return redirect('recommendations')->with('success', 'Skierowanie zostało dodane');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recommendation = Recommendation::find($id);
        $doctor = Doctor::get(['id', 'name', 'surname'])->pluck('full_name', 'id');
        $subuser_id = session()->get('subuser_id');
        return view('recommendations.show', compact('recommendation', 'doctor', 'subuser_id'));
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
        $recommendation = Recommendation::find($id);
        $doctors = Doctor::get(['id', 'name', 'surname'])->pluck('full_name', 'id');
        return view('recommendations.edit', compact('recommendation', 'doctors', 'subuser_id'));
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
        $recommendation = Recommendation::find($id);
        $recommendation->name = $request->input('name');
        $recommendation->subuser_id = $request->input('subuser_id');
        $recommendation->doctor_id_from = $request->input('doctor_from');
        $recommendation->doctor_id_to = $request->input('doctor_to');
        $recommendation->description = $request->input('description');
        if ($request->file('photo')!=null) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('public/recommendations/'.$request->session()->get('subuser_id'), $filenameToStore);
            $recommendation->photo = $filenameToStore;
        }

        $recommendation->save();
        return redirect()->action('RecommendationsController@index')->with('Success', 'Skierowanie zostało zaktualizowane');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recommendation = Recommendation::find($id);
        $recommendation->delete();
        return redirect('/recommendations')->with('success', 'Skierowanie zostało usunięte');
    }
}
