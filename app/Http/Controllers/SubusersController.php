<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subuser;

class SubusersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function storeToSession($id)
    {
        session(['subuser_id' => $id]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subusers.createsubuser');
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
          'subname'=>'required',
          'address'=>'required',
          'phone'=>'required'
        ],
            [
        'name.required' => 'Pole imię jest wymagane',
        'subname.required' => 'Pole nazwisko jest wymagane',
        'address.required' => 'Pole adres jest wymagane',
        'phone.required' => 'Pole numer telefonu jest wymagane'
        ]
        );
        $subuser = new Subuser;
        $subuser->name = $request->input('name');
        $subuser->subname = $request->input('subname');
        $subuser->address = $request->input('address');
        $subuser->phone = $request->input('phone');
        $subuser->about = $request->input('about');
        $subuser->user_id = auth()->user()->id;
        $subuser->save();
        return redirect('/dashboard')->with('success', 'Podopieczny dodany');
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
        $subuser=Subuser::find($id);
        return view('subusers.editsubuser')->with('subuser', $subuser);
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
        'subname'=>'required',
        'address'=>'required',
        'phone'=>'required'
      ],
            [
      'name.required' => 'Pole imię jest wymagane',
      'subname.required' => 'Pole nazwisko jest wymagane',
      'address.required' => 'Pole adres jest wymagane',
      'phone.required' => 'Pole numer telefonu jest wymagane'
      ]
        );
        $subuser = Subuser::find($id);
        $subuser->name = $request->input('name');
        $subuser->subname = $request->input('subname');
        $subuser->address = $request->input('address');
        $subuser->phone = $request->input('phone');
        $subuser->about = $request->input('about');
        $subuser->user_id = auth()->user()->id;
        $subuser->save();
        return redirect('/dashboard')->with('success', 'Podopieczny zaktualizowany');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subuser = Subuser::find($id);
        $subuser->delete();
        return redirect('/dashboard')->with('success', 'Podopieczny usunięty');
    }
}
