<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Carbon\Carbon;

class CheckEventsController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     */
    public function check()
    {
        $events = Event::where('subuser_id', '=', session()->get('subuser_id'))->whereDate('start_date', '=', Carbon::now()->toDateString())->orderBy('start_date', 'asc')->get();
        if (count($events)!=0) {
            if (isset($_COOKIE['display'])) {
                if ($_COOKIE['display']=='yes') {
                    return "Uwaga w terminarzu istnieją wpisy[". (count($events)) ."] z dzisiejszą datą!";
                }
            } else {
                return "Uwaga w terminarzu istnieją wpisy[". (count($events)) ."] z dzisiejszą datą!";
            }
        } else {
            return "";
        }
    }
}
