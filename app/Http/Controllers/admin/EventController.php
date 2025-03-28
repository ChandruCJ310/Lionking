<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\PastEvent;

class EventController extends Controller
{
public function index(){
    return view("admin.Event.index");
}

    // Store a new event
    public function store(Request $request)
    {

        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
        ]);

        Event::create([
            'event_name' => $request->event_name,
            'event_date' => $request->event_date,
        ]);

        return back()->with('success', 'Event added successfully!');
    }




public function storeCompletedEvent(Request $request)
{
    $request->validate([
        'event_id' => 'required|exists:events,id',
        'venue' => 'required|string|max:255',
        'details' => 'required|string',
        'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $imagePaths = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imagePaths[] = $image->store('past_event_images', 'public');
        }
    }

    PastEvent::create([
        'event_id' => $request->event_id,
        'venue' => $request->venue,
        'details' => $request->details,
        'images' => $imagePaths,
    ]);

    return back()->with('success', 'Past event added successfully!');
}



}
