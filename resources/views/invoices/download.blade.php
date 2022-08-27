@extends('layouts.dashboard')




@section('content')


<div class="container-fluid p-4">



    <div class="invoice-wrapperxxx">

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
                    <p>{{ $invoice->contact->first_name }} {{ $invoice->contact->last_name }}</p>
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

        @endif



    </div>



</div>


@endsection