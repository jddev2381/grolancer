<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Contact;
use App\Models\LineItem;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoicesController extends Controller
{
    public function index() {
        $invoices = Invoice::where('user_id', auth()->user()->id)->paginate(15);
        return view('invoices.index', ['invoices' => $invoices]);
    }

    public function create(){
        return view('invoices.create');
    }

    // Store new invoice
    public function store(Request $request) {
        $request->validate([
            'contact' => 'required|exists:contacts,id',
            'due_date' => 'required|date',
        ]);
        $invoice = new Invoice();
        $invoice->contact_id = $request->input('contact');
        $invoice->due_date = $request->input('due_date');
        $invoice->user_id = auth()->user()->id;
        $invoice->save();
        return redirect('/invoices/'. $invoice->id . '/create')->with('message', 'Invoice created successfully');
    }

    public function addLineItem(Invoice $invoice) {
        $items = LineItem::where('invoice_id', $invoice->id)->get();
        return view('invoices.add-line-items', ['invoice' => $invoice, 'items' => $items]);
    }

    public function storeLineItem(Request $request, Invoice $invoice) {
        $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
        ]);
        $lineItem = new LineItem();
        $lineItem->description = $request->input('description');
        $lineItem->amount = $request->input('amount');
        $lineItem->invoice_id = $invoice->id;
        $lineItem->save();
        return redirect('/invoices/'. $invoice->id . '/create')->with('message', 'Line item added successfully');
    }

    // delete line item
    public function deleteLineItem(Invoice $invoice, $lineItemId) {
        $lineItem = LineItem::find($lineItemId);
        if(!$lineItem) {
            return redirect('/invoices/'. $invoice->id . '/create')->with('message', 'Line item not found');
        }
        $lineItem->delete();
        return redirect('/invoices/'. $invoice->id . '/create')->with('message', 'Line item deleted successfully');
    }

    // Toggle Paid
    public function togglePaid(Invoice $invoice) {
        $invoice->paid = !$invoice->paid;
        if($invoice->paid) {
            $status = 'Paid';
        } else {
            $status = 'Unpaid';
        }
        $invoice->save();
        return back()->with('message', 'Invoice ' . $invoice->id . ' changed to ' . $status);
    }

    public function downloadInvoice(Invoice $invoice) {
        $items = LineItem::where('invoice_id', $invoice->id)->get();
        $pdf = PDF::loadView('pdf.invoice', ['invoice' => $invoice, 'items' => $items]);
        return $pdf->stream();
    }

    // Delete invoice
    public function destroy(Invoice $invoice) {
        $invoice->delete();
        return back()->with('message', 'Invoice deleted successfully');
    }
}
