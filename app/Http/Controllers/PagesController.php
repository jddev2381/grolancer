<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Task;

class PagesController extends Controller
{
    // Show dashboard 
    public function index() {
        // get all contacts for the current user
        $contacts = Contact::where(['user_id' => auth()->user()->id])->get();
        $tasks = Task::where(['user_id' => auth()->user()->id, 'completed' => false])->get();
        return view('dashboard.index', ['contacts' => $contacts, 'tasks' => $tasks]);
    }

    public function billing() {
        return view('dashboard.billing');
    }
}
