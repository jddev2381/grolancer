<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeSlot;
use App\Models\Contact;


class TimeSlotController extends Controller
{
    // index
    public function index() {
        $clients = Contact::where(['user_id' => auth()->user()->id, 'type' => 'client'])->orderBy('last_name')->get();
        $slots = TimeSlot::where('user_id', auth()->user()->id)->orderBy('start_time')->paginate(15);
        return view('timeslots.index', ['slots' => $slots, 'clients' => $clients]);
    }

    // Store
    public function store(Request $request) {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'contact_id' => 'required',
        ]);

        $slot = new TimeSlot();
        $slot->user_id = auth()->user()->id;
        $slot->contact_id = $request->contact_id;
        $slot->start_time = now();
        $slot->name = $request->name;
        $slot->save();

        return back()->with('message', 'Timer Started.');
    }

    // Stop Timer
    public function stopTimer($id) {
        $slot = TimeSlot::find($id);
        $slot->end_time = now();
        $slot->save();

        return back()->with('message', 'Timer Stopped.');
    }

    // Delete
    public function destroy($id) {
        if(auth()->user()->id == TimeSlot::find($id)->user_id) {
            TimeSlot::find($id)->delete();
            return back()->with('message', 'Timer Deleted.');
        }
        return back()->with('message', 'You do not have permission to delete this timer.');
    }

    // Update billed
    public function markBilled(TimeSlot $timeSlot) {
        if(auth()->user()->id !== $timeSlot->user_id) {
            return back()->with('message', 'Unauthorized Access.');
        }
        if($timeSlot->status == 'pending') {
            $timeSlot->status = 'billed';
            $timeSlot->save();
            return back()->with('message', 'Timer marked as billed.');
        }
        $timeSlot->status = 'pending';
        $timeSlot->save();
        return back()->with('message', 'Timer toggled to pending.');
    }
}
