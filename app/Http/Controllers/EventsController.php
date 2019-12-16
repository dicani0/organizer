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
        $events = Event::all();
        $event =[];

        foreach ($events as $row) {
            $enddate = $row->end_date."24:00:00";
            $event[] = \Calendar::event(
                $row->title,
                true,
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
        return view('calendar.addevent');
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dump($request->input);
        $this->validate($request, [
          'title' => 'required',
          'color' => 'required',
          'start_date' => 'required',
          'end_date' => 'required'
        ]);

        $events = new Event;
        $event->title = $request->input('title');
        $event->color = $request->input('color');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');

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
