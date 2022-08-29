<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use App\Models\Activity;
use App\Models\Task;
use App\Models\Invoice;

class ContactsController extends Controller
{
   // show contacts
   public function index(Request $request) {
        $contacts = Contact::where('user_id', auth()->user()->id)->filter(request(['search']))->filter(request(['type']))->orderBy('last_name')->paginate(15);
        return view('contacts.index', ['contacts' => $contacts]);
   }

    // show create contact form
    public function create() {
        return view('contacts.create');
    }

    // create new contact
    public function store(Request $request) {
        //dd($request->all());
        // validate form data
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'nullable|max:255',
            'email' => 'nullable|email|max:255',
            'title' => 'nullable|max:255',
            'company_name' => 'nullable|max:255',
            'website' => 'nullable|max:255',
            'mobile' => 'nullable|max:255|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'phone' => 'nullable|max:255|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'street' => 'nullable|max:255',
            'city' => 'nullable|max:255',
            'state' => 'nullable|max:2',
            'zip' => 'nullable|max:5',
            'type' => 'nullable|max:255',
        ]);
        // store in the database
        $theType = $request->input('type') ? $request->input('type') : 'prospect';
        $contact = new Contact;
        $contact->user_id = auth()->user()->id;
        $contact->first_name = $request->input('first_name');
        $contact->last_name = $request->input('last_name');
        $contact->email = $request->input('email');
        $contact->mobile = $request->input('mobile');
        $contact->phone = $request->input('phone');
        $contact->title = $request->input('title');
        $contact->company_name = $request->input('company_name');
        $contact->website = $request->input('website');
        $contact->street = $request->input('street');
        $contact->city = $request->input('city');
        $contact->state = $request->input('state');
        $contact->zip = $request->input('zip');
        $contact->type = $theType;
        $contact->save();
        // redirect to contacts page
        return redirect('/contacts')->with('message', $request->input('first_name') . ' ' . $request->input('last_name') . ' has been added as a ' . $theType);
    }

    // show edit contact form
    public function edit($id) {
        $contact = Contact::find($id);
        if(!$contact) {
            return redirect('/contacts')->with('message', 'Contact not found');
        }
        if($contact->user_id != auth()->user()->id) {
            return redirect('/contacts')->with('message', 'You don\'t have permission to edit that contact');
        }
        return view('contacts.edit', ['contact' => $contact]);
    }

    // update contact
    public function update(Request $request, $id) {
        $contact = Contact::find($id);
        if(!$contact) {
            return redirect('/contacts')->with('message', 'Contact not found');
        }
        if($contact->user_id != auth()->user()->id) {
            return redirect('/contacts')->with('message', 'You don\'t have permission to edit that contact');
        }
        // validate form data
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'nullable|max:255',
            'email' => 'nullable|email|max:255',
            'title' => 'nullable|max:255',
            'company_name' => 'nullable|max:255',
            'website' => 'nullable|max:255',
            'mobile' => 'nullable|max:255|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'phone' => 'nullable|max:255|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'street' => 'nullable|max:255',
            'city' => 'nullable|max:255',
            'state' => 'nullable|max:2',
            'zip' => 'nullable|max:5',
            'type' => 'nullable|max:255',
        ]);
        // update the database
        $theType = $request->input('type') ? $request->input('type') : 'prospect';
        $contact->first_name = $request->input('first_name');
        $contact->last_name = $request->input('last_name');
        $contact->email = $request->input('email');
        $contact->mobile = $request->input('mobile');
        $contact->phone = $request->input('phone');
        $contact->street = $request->input('street');
        $contact->city = $request->input('city');
        $contact->title = $request->input('title');
        $contact->company_name = $request->input('company_name');
        $contact->website = $request->input('website');
        $contact->state = $request->input('state');
        $contact->zip = $request->input('zip');
        $contact->type = $theType;
        $contact->update();

        // redirect to contacts page
        return redirect('/contacts/' . $id)->with('message', 'Contact has been updated');
    }

    // delete contact
    public function destroy($id) {
        $contact = Contact::find($id);
        if(!$contact) {
            return redirect('/contacts')->with('message', 'Contact not found');
        }
        if($contact->user_id != auth()->user()->id) {
            return redirect('/contacts')->with('message', 'You don\'t have permission to delete that contact');
        }
        $name = $contact->first_name . ' ' . $contact->last_name;
        $contact->delete();
        return redirect('/contacts')->with('message', $name . ' has been deleted');
    }

    // Show single contact page
    public function show($id) {
        $contact = Contact::find($id);
        if(!$contact) {
            return redirect('/contacts')->with('message', 'Contact not found');
        }
        if($contact->user_id != auth()->user()->id) {
            return redirect('/contacts')->with('message', 'You don\'t have permission to view that contact');
        }
        $tasks = Task::where(['contact_id' => $id, 'completed' => false])->orderBy('due_date')->get();
        $invoices = Invoice::where('contact_id', $id)->get();
        $activities = Activity::where('contact_id', $id)->orderBy('created_at', 'DESC')->get();
        return view('contacts.show', ['contact' => $contact, 'activities' => $activities, 'tasks' => $tasks, 'invoices' => $invoices]);
    }

    // Log activity for contact
    public function logActivity(Request $request, $id) {
        // validate form data
        $this->validate($request, [
            'direction' => 'required|max:255',
            'type' => 'required|max:255',
            'comment' => 'required|min:3',
        ]);
        $contact = Contact::find($id);
        if(!$contact) {
            return redirect('/contacts')->with('message', 'Contact not found');
        }
        if($contact->user_id != auth()->user()->id) {
            return redirect('/contacts')->with('message', 'You don\'t have permission to view that contact');
        }
        $activity = new Activity;
        $activity->contact_id = $id;
        $activity->direction = $request->input('direction');
        $activity->type = $request->input('type');
        $activity->comment = $request->input('comment');
        $activity->save();
        return redirect('/contacts/' . $id)->with('message', 'Activity has been logged');
    }

    // delete activity
    public function deleteActivity($contactId, $activityId) {
        $activity = Activity::find($activityId);
        if(!$activity) {
            return redirect('/contacts')->with('message', 'Activity not found');
        }
        if($activity->contact->user_id != auth()->user()->id) {
            return redirect('/contacts')->with('message', 'You don\'t have permission to delete that activity');
        }
        $activity->delete();
        return redirect('/contacts/' . $activity->contact_id)->with('message', 'Activity has been deleted');
    }
}
