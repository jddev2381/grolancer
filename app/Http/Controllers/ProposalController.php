<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\ProposalSection;
use Illuminate\Support\Str;
use Mail;
use App\Mail\SendProposal;
use App\Mail\SendProposalPDF;
use Barryvdh\DomPDF\Facade\Pdf;

class ProposalController extends Controller
{
    // Show Proposals
    public function index() {
        $proposals = Proposal::where('user_id', auth()->user()->id)->paginate(15);
        return view('proposals.index', ['proposals' => $proposals]);
    }

    // Store Proposal
    public function store(Request $request) {
        // Validate form data
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'contact' => 'required|integer',
            'amount' => 'required|numeric',
        ]);
        $proposal = new Proposal;
        $proposal->user_id = auth()->user()->id;
        $proposal->contact_id = $request->contact;
        $proposal->name = $request->name;
        $proposal->amount = $request->amount;
        $proposal->token = Str::random(5);
        $proposal->save();
        return redirect('/proposals/' . $proposal->id)->with('message', 'Proposal created. Now add your sections.');
    }

    // Show Proposal
    public function show(Proposal $proposal) {
        $sections = ProposalSection::where('proposal_id', $proposal->id)->get();
        // $proposal = Proposal::find($proposal->id);
        // if($proposal->status == 'accepted') {
        //     return back()->with('message', 'You cannot edit this section because the proposal has been accepted');
        // }
        return view('proposals.show', ['proposal' => $proposal, 'sections' => $sections]);
    }

    // Add Section
    public function addSection(Proposal $proposal, Request $request) {
        // validate form data
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        $section = new ProposalSection;
        $section->proposal_id = $proposal->id;
        $section->title = $request->title;
        $section->body = $request->body;
        $section->save();
        return back()->with('message', 'Section added successfully');
    }

    // Edit Propsal Section
    public function editSection(Proposal $proposal, ProposalSection $section) {
        return view('proposals.edit-section', ['proposal' => $proposal, 'section' => $section]);
    }

    // Update Proposal Section
    public function updateSection(Proposal $proposal, ProposalSection $section, Request $request) {
        // validate form data
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        $section->title = $request->title;
        $section->body = $request->body;
        $section->save();
        return redirect('/proposals/' . $proposal->id)->with('message', 'Section updated successfully');
    }

    // Delete Proposal Section
    public function deleteSection(Proposal $proposal, ProposalSection $section) {
        if($section->proposal_id != $proposal->id) {
            return back()->with('message', 'Section not found');
        }
        $section->delete();
        return back()->with('message', 'Section deleted successfully');
    }

    // Customer View Proposal
    public function viewProposal(Proposal $proposal, $tok) {
        if($proposal->token != $tok) {
            return back()->with('message', 'Invalid token');
        }
        $sections = ProposalSection::where('proposal_id', $proposal->id)->get();
        return view('proposals.customer-view', ['proposal' => $proposal, 'sections' => $sections]);
    }

    // Accept Proposal
    public function acceptProposal(Proposal $proposal, $tok, Request $request) {
        if($proposal->token != $tok) {
            return back()->with('message', 'Invalid token');
        }
        // validate form data
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);
        $proposal->accepted_name = $request->name;
        $proposal->accepted_date = date('Y-m-d H:i:s');
        $proposal->accepted_ip = request()->ip();
        $proposal->accepted_user_agent = request()->header('User-Agent');
        $proposal->status = 'accepted';
        $proposal->save();
        // Send email with link to download pdf
        $mailData = [
            'to_name' => $proposal->accepted_name,
            'url' => url('/proposal/' . $proposal->id . '/download/' . $proposal->token),
        ];
        Mail::to($proposal->contact->email)->send(new SendProposalPDF($mailData));

        return redirect('/proposal/' . $proposal->id . '/view/' . $proposal->token)->with('message', 'Proposal accepted!');
    }

    // Delete Proposal
    public function destroy(Proposal $proposal) {
        if($proposal->user_id != auth()->user()->id) {
            return back()->with('message', 'Proposal not found');
        }
        $proposal->delete();
        return redirect('/proposals')->with('message', 'Proposal deleted successfully');
    }

    // Send Proposal
    public function sendProposal(Proposal $proposal) {
        if($proposal->user_id != auth()->user()->id) {
            return back()->with('message', 'Proposal not found');
        }
        // Send email
        $mailData = [
            'to_name' => $proposal->contact->first_name . ' ' . $proposal->contact->last_name,
            'to_email' => $proposal->contact->email,
            'from_name' => $proposal->user->first_name . ' ' . $proposal->user->last_name,
            'url' => url('/proposal/' . $proposal->id . '/view/' . $proposal->token),
        ];
        Mail::to($proposal->contact->email)->send(new SendProposal($mailData));
        $proposal->status = 'sent';
        $proposal->save();
        return redirect('/proposals/' . $proposal->id)->with('message', 'Proposal sent successfully');
    }

    // Download Proposal
    public function downloadProposal(Proposal $proposal, $tok) {
        if($proposal->token != $tok) {
            return 'Unauthorized';
        }
        $sections = ProposalSection::where('proposal_id', $proposal->id)->get();
        $pdf = PDF::loadView('pdf.proposal', ['proposal' => $proposal, 'sections' => $sections]);
        
        return $pdf->stream();
    }
}
