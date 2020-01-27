<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckSubuserController extends Controller
{
    public static function check()
    {
        $session_id = session('subuser_id', false);
        if (!$session_id) {
            \Redirect::back()->send()->with('error', 'Brak wybranego podopiecznego');
        }
    }
}
