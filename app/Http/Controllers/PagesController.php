<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class PagesController extends Controller
{
    // Show dashboard 
    public function index() {
        // get all contacts for the current user
        $contacts = Contact::where(['user_id' => auth()->user()->id])->get();
        return view('dashboard.index', ['contacts' => $contacts]);
    }

    public function billing() {
        return view('dashboard.billing');
    }
}
