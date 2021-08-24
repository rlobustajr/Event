<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\event_tbl;

class EventController extends Controller
{
    //insert event
    public function insertEvent(Request $request){
        $insert_event = new event_tbl();
        $insert_event = $insert_event->insertEvent($request->all());
        return $insert_event;
    }

    //select event
    public function selectEvent(Request $request){
        $select_event = new event_tbl();
        $select_event = $select_event->selectEvent($request->all());
        return $select_event;
    }
}
