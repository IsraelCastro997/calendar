<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function store(Request $request)
    {
        request()->validate(Event::$rules);
        $data = $request->all();
        // $data['owner_id'] = Auth::id();
        $data['owner_id'] = 1;
        $event = Event::create($data);
        return response()->json($event);
    }

    public function show()
    {
        $event = Event::all();
        if ($event) 
            return response()->json($event);
        
            return response()->json(false);
    }

    public function edit(int $id)
    {
        $event = Event::find($id);
        return response()->json($event);
    }

    public function destroy(int $id)
    {
        $event = Event::find($id)->delete();

        return response()->json($event);
    }

    public function update(Request $request, Event $event)
    {
        request()->validate(Event::$rules);
        // $data = $request->all();
        // $data['owner_id'] = Auth::id();
        $event->update($request->all());

        return response()->json($event);
    }
}
