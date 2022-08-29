@extends('layouts.dashboard')




@section('content')


<div class="container-fluid p-4">


    <div class="row d-flex align-items-center justify-content-end mb-4">
        
        <div class="col-auto">
            <a href="/invoices" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Invoices
            </a>
        </div>
    </div>

    <div class="invoice-wrapper">


        @if($invoice->paid)
            <img id="paid" src="{{ asset('img/paid-stamp.png') }}" alt="Paid">
        @endif

        <div class="row d-flex align-items-center justify-content-between">
            <div class="col">
                <div class="invoice-logo">
                    @if(auth()->user()->logo)
                        <img src="{{ asset('storage/' . auth()->user()->logo) }}" alt="{{ auth()->user()->business_name }}">
                    @else
                        <p>Add Logo in <a href="/users/edit">account settings</a></p>
                    @endif
                </div>
            </div>
            <div class="col data">
                <h5 class="text-muted mb-3">Invoice # <span class="holder">{{ $invoice->id }}</span></h5>
                <h5 class="text-muted">Due Date: <span class="holder">{{ $invoice->due_date ? date('m/d/Y', strtotime($invoice->due_date)) : '' }}</span></h5>
            </div>
        </div>

        <div class="row d-flex justify-content-between mt-5">
            <div class="col-4">
                <div class="from">
                    <h6>From</h6>
                    <p>
                        @if(auth()->user()->business_name)
                            {{ auth()->user()->business_name }}
                        @else
                            Add Business Name in <a href="/users/edit">account settings</a>
                        @endif
                    </p>
                </div>
            </div>
            <div class="col-4">
                <div class="to">
                    <h6>To</h6>
                    <p><a href="/contacts/{{$invoice->contact->id}}">{{ $invoice->contact->first_name }} {{ $invoice->contact->last_name }}</a></p>
                </div>
            </div>
        </div>


        <div class="row border-bottom mt-5">
            <div class="col">
                <h5>Item</h5>
            </div>
            <div class="col">
                <h5 class="text-right">Amount</h5>
            </div>
        </div>

        @php
            $total = 0;
        @endphp

        @if($items->count() > 0)

            @foreach($items as $item)

                <div class="row d-flex justify-content-between align-items-center mt-3">
                    <div class="col">
                        <div class="item">
                            <p class="text-muted">{{ $item->description}}</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="amount">
                            <p class="text-right">{{ $item->amount }}</p>
                        </div>
                    </div>
                    <div class="col-1 text-right">
                        <form action="/invoices/{{$invoice->id}}/items/{{ $item->id }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @php
                    $total += $item->amount;
                @endphp
            @endforeach
            <hr>
            <div class="row">
                <div class="col-9 text-right">
                    <h5>Total: </h5>
                </div>
                <div class="col-3">
                    <h5 class="text-right">${{ number_format((float)$total, 2, '.', '') }}</h5>
                </div>
            </div>

        @else 

            <div class="row mt-3 mb-3">
                <div class="col">
                    <p class="text-center">There are no items on this invoice.</p>
                </div>
            </div>

        @endif

        
        

        @if(!$invoice->paid)
            <form action="/invoices/{{$invoice->id}}/create" method="POST">
                @csrf 
                <div class="row mt-3">
                    <div class="col-9">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="{{ old('description') }}">
                            <label for="description">Description</label>
                            @error('description')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-floating mb-3 text-right">
                            <input type="number" class="form-control text-right" id="amount" name="amount" placeholder="Amount" value="{{ old('amount') }}">
                            <label for="amount">Amount</label>
                            @error('amount')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-logo"><i class="fa-solid fa-plus me-1"></i> Add Item</button>
                </div>
            </form>
        @endif





        @if(auth()->user()->paypal_link || auth()->user()->cashapp_tag)
            <div class="row mt-5 mb-3">
                <div class="col payments">
                    <h6>Payment Options:</h6>
                    @if(auth()->user()->paypal_link)
                        <p><b>Paypal:</b> {{ auth()->user()->paypal_link }}</p>
                    @endif
                    @if(auth()->user()->cashapp_tag)
                        <p><b>Cashapp:</b> ${{ auth()->user()->cashapp_tag }}</p>
                    @endif
                </div>
            </div>

        @else 
            <p class="lead mt-5">Set Payment Options In <a href="/users/edit">Account Settings</a></p>
        @endif



    </div>


    @if(!$invoice->paid)
        <a class="btn btn-logo btn-lg btn-block w-100 mt-5 mb-5" href="/invoices/{{ $invoice->id }}/download" target="_blank">Download Invoice</a>
    @endif


</div>


@endsection