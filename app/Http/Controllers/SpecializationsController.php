<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialization;

class SpecializationsController extends Controller
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
        $specializations = Specialization::all();
        return view('specializations.index', compact('specializations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('specializations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required|unique:specializations,name'
        ], [
          'name.required'=>'Polę specjalizacja jest wymagane',
          'name.unique' => 'Taka specjalizacja już istnieje'
        ]);
        $specialization = new Specialization();
        $specialization->name = $request->input('name');
        $specialization->save();
        return redirect('doctors');
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
        $specialization = Specialization::find($id);
        return view('specializations.edit')->with('specialization', $specialization);
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
          'name' => 'required|unique:specializations,name'
        ],
            [
          'name.required' => 'Polę specjalizacja jest wymagane',
          'name.unique' => 'Taka specjalizacja już istnieje'
        ]
        );
        $specialization = Specialization::find($id);
        $specialization->name=$request->input('name');
        $specialization->save();
        return redirect('/doctors')->with('success', 'Specjalizacja zaktualizowana');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specialization = Specialization::find($id);
        $specialization->delete();
    }
}
