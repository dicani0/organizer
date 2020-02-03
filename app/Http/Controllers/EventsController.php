<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        CheckSubuserController::check();
        $events = Event::where('subuser_id', '=', session()->get('subuser_id'))->get();
        $event =[];

        foreach ($events as $row) {
            //$enddate = $row->end_date."24:00:00";
            $event[] = \Calendar::event(
                $row->title,
                false,
                new \DateTime($row->start_date),
                new \DateTime($row->end_date),
                $row->id,
                [
            'color' => $row->color,
          ]
            );
        }
        $calendar = \Calendar::addEvents($event);
        return view('calendar.events', compact('events', 'calendar'));
    }
    public function indexForAll()
    {
        CheckSubuserController::check();
        $events = Event::all();
        $event =[];

        foreach ($events as $row) {
            //$enddate = $row->end_date."24:00:00";
            $event[] = \Calendar::event(
                $row->title,
                false,
                new \DateTime($row->start_date),
                new \DateTime($row->end_date),
                $row->id,
                [
            'color' => $row->color,
          ]
            );
        }
        $calendar = \Calendar::addEvents($event);
        return view('calendar.events', compact('events', 'calendar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function display()
    {
        $events = Event::where('subuser_id', '=', session()->get('subuser_id'))->get();
        return view('calendar.list', compact('events'));
    }
    public function create()
    {
        return view('calendar.create');
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
          'title' => 'required',
          'color' => 'required',
          'start_date' => 'required',
          'end_date' => 'required'
        ]);

        $event = new Event;
        $event->title = $request->input('title');
        $event->subuser_id = session('subuser_id');
        $event->color = $request->input('color');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->description = $request->input('description');
        $event->save();

        return redirect('events')->with('success', 'Wydarzenie dodane');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
