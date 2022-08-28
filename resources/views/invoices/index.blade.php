@extends('layouts.dashboard')



@section('content')

<div class="container-fluid p-4">

    <div class="row d-flex align-items-center justify-content-between mb-4">
        <div class="col">
            <h3>Invoices</h3>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Recipient</th>
                        <th class="text-right">Total</th>
                        <th class="text-center">Status</th>
                        <th>Due Date</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($invoices->count() > 0)
                        @foreach($invoices as $invoice) 
                            <tr>
                                <td class="align-middle">
                                    {{ $invoice->id }}
                                </td>
                                <td class="align-middle">
                                    <a href="/contacts/{{ $invoice->contact_id }}">{{ $invoice->contact->first_name }} {{ $invoice->contact->last_name }}</a>
                                </td>
                                <td class="align-middle text-right">
                                    @if($invoice->paid)
                                        <s>${{ number_format((float)$invoice->lineItems->sum('amount'), 2, '.', '')  }}</s>
                                    @else
                                        ${{ number_format((float)$invoice->lineItems->sum('amount'), 2, '.', '')  }}
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    {{ $invoice->paid ? 'PAID' : 'Unpaid' }}
                                </td>
                                <td class="align-middle">
                                    {{ $invoice->due_date ? date('m/d/Y', strtotime($invoice->due_date)) : '' }}
                                </td>
                                <td class="align-middle text-center">
                                    <a href="/invoices/{{ $invoice->id }}/create" class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                                <td class="align-middle text-center">
                                    <form action="/invoices/{{$invoice->id}}/pay" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fa-solid fa-dollar-sign"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="align-middle text-center">
                                    <form action="invoices/{{ $invoice->id }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center">
                                <span class="text-muted">No invoices found.</span>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            {{ $invoices->links() }}

        </div>



        {{-- <div class="col-sm-4">

            <form action="/invoices" method="POST">
                @csrf 
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="due_date" name="due_date" placeholder="Due Date" value="{{ old('due_date') }}">
                    <label for="due_date">Due Date</label>
                    @error('due_date')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <select class="form-select" id="contact" name="contact">
                        <option value="">Select Contact</option>
                        @foreach($contacts as $contact)
                            <option value="{{ $contact->id }}" {{ old('contact') == $contact->id ? 'selected' : '' }}>
                                {{ $contact->last_name }}, {{ $contact->first_name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="contact">Contact</label>
                    @error('contact')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>


                <div class="d-flex justify-content-end mb-3">
                    <button type="submit" class="btn btn-logo">
                        <i class="fa-solid fa-plus me-1"></i> New Invoice
                    </button>
                </div>
            </form>

        </div> --}}
    </div>








</div>

@endsection