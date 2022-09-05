@extends('layouts.plain')

@section('content')


<nav>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <p>Welcome {{  $proposal->contact->first_name }} {{  $proposal->contact->last_name }}</p>
            @if($proposal->status != 'accepted')
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#signModal">Accept Proposal</a>
            @else 
                <a href="#signature" class="btn btn-warning">Proposal Accepted</a>
            @endif
    </div>
</nav>

<div class="container">

    <div class="proposal-wrapper">
        <div class="row d-flex align-items-center justify-content-between mb-5">
            <div class="col">
                <div class="proposal-logo">
                    @if($proposal->user->logo)
                        <img src="{{ asset('storage/' . $proposal->user->logo) }}" alt="{{ $proposal->user->business_name }}">
                    @else
                        <p>Add Logo in <a href="/users/edit">account settings</a></p>
                    @endif
                </div>
            </div>
            <div class="col data">
                <h5 class="text-muted mb-3">Proposal ID: <span class="holder">{{ $proposal->id }}</span></h5>
                <h5 class="text-muted">Amount: <span class="holder">{{ $proposal->amount  }}</span></h5>
            </div>
        </div>



        <div class="row my-5">
            <h1 class="text-center my-5">{{ $proposal->name }}</h1>
        </div>

        <div class="row my-5">
            <h2 class="text-center my-5">
                Prepared For: <span class="holder">{{ $proposal->contact->first_name }} {{ $proposal->contact->last_name }}</span>    
            </h2>
        </div>






        <div class="row mt-5">
            <div class="col-12">

                @foreach($sections as $section)
                    <div class="proposal-section">
                        <h3 class="title">{{ $section->title }}</h3>
                        <div class="section-body">
                            {!! $section->body !!}
                        </div>
                    
                    </div>
                @endforeach






                <p class="lead mt-5 mb-5">By signing below, you agree to the terms of this proposal.</p>

                <div class="sigs">
                    <div class="sig1">
                        <p class="name">{{ $proposal->user->first_name }} {{ $proposal->user->last_name }}</p>
                        <p class="date text-muted p-0 m-0">
                            {{ $proposal->user->first_name }} {{ $proposal->user->last_name }}<br>
                            {{ date('m/d/Y', strtotime($proposal->created_at)) }}
                        </p>
                    </div>
                    <div id="signature" class="sig2">
                        @if($proposal->status != 'accepted')
                            <a href="#" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#signModal">Sign</a>
                        @endif
                        <p class="name">
                            {{ $proposal->accepted_name }}
                        </p>
                        <p class="date text-muted p-0 m-0">
                            {{ $proposal->contact->first_name }} {{ $proposal->contact->last_name }}<br>
                            @if($proposal->accepted_date)
                                {{ date('m/d/Y', strtotime($proposal->accepted_date)) }}<br>
                            @else
                                {{ date('m/d/Y') }}
                            @endif
                            
                        </p>
                    </div>
                </div>

            </div>
        </div>





    </div>

</div>

<!-- Sign Modal -->
<div class="modal fade" id="signModal" tabindex="-1" aria-labelledby="signModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signModalLabel">Sign Proposal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <p class="lead">By typing your name below and clicking "Sign & Accept Proposal" you are agreeing to the terms of this proposal and your signature will be recorded.</p>
                        <p>Once accepted, you will be emailed a copy of the signed proposal.</p>
                        <form action="/proposal/{{$proposal->id}}/view/{{$proposal->token}}" method="POST">
                            @csrf 

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="{{ old('name') }}">
                                <label for="name">Your Name As It Appears On Proposal</label>
                                @error('name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" name="ip" value="{{ request()->ip() }}">
                            <input type="hidden" name="user_agent" value="{{ request()->userAgent() }}">
                            <div class="meta-info">
                                <p class="text-muted"><b>IP Address:</b> {{ request()->ip() }}</p>
                                <p class="text-muted"><b>User Agent:</b> {{ request()->userAgent() }}</p>
                                <p class="text-muted"><b>Timestamp:</b> {{ date('m/d/Y h:i:s A') }} UTC</p>
                            </div>
                            <div class="d-flex justify-content-end mt-2">
                                <button type="submit" class="btn btn-primary">Sign & Accept Proposal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
                
           
        </div>
    </div>




@endsection