@extends('layouts.dashboard')



@section('content')


<div class="container-fluid p-4">

    <div class="row d-flex align-items-center justify-content-end mb-4">
        
        <div class="col-auto">
            <a href="/proposals" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Proposals
            </a>
        </div>
    </div>

    <div class="proposal-wrapper">

        <div class="row d-flex align-items-center justify-content-between mb-5">
            <div class="col">
                <div class="proposal-logo">
                    @if(auth()->user()->logo)
                        <img src="{{ asset('storage/' . auth()->user()->logo) }}" alt="{{ auth()->user()->business_name }}">
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
                Prepared For: <a href="/contacts/{{$proposal->contact->id}}"><span class="holder">{{ $proposal->contact->first_name }} {{ $proposal->contact->last_name }}</span></a>
            </h2>
        </div>

        <div class="row mt-5">
            <div class="col-12">

                @if($sections->count() > 0)
                    @foreach($sections as $section)
                        <div class="proposal-section">
                            <h3 class="title">{{ $section->title }}</h3>
                            <div class="section-body">
                                {!! $section->body !!}
                            </div>


                            @if($proposal->status != 'accepted' && $proposal->status != 'sent')
                        
                                <div class="d-flex">
                                    <a href="/proposals/{{ $proposal->id }}/sections/{{ $section->id }}/edit" class="btn btn-primary me-2">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="/proposals/{{$proposal->id}}/sections/{{ $section->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>

                            @endif



                        </div>
                    @endforeach

                    

                @else
                    <div class="section">
                        <h3 class="text-center">Please Add Sections Below</h3>
                    </div>
                @endif



                @if($proposal->status != 'accepted' && $proposal->status != 'sent')

                    <div class="card mt-5">
                        <div class="card-header">
                            <h3 class="card-title">Add Section</h3>
                        </div>
                        <div class="card-body">
                            <form action="/proposals/{{ $proposal->id }}/sections" method="POST">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
                                    <label for="title">Section Title</label>
                                    @error('title')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="body" name="body" placeholder="Create Section Here" rows="3">{{ old('body') }}</textarea>
                                    <label for="body">Section Body</label>
                                    @error('body')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary mt-2">Add Section</button>
                                </div>
                            </form>
                        </div>
                    </div>
                
                @endif





                <p class="lead mt-5 mb-5">By signing below, you agree to the terms of this proposal.</p>

                <div class="sigs">
                    <div class="sig1">
                        <p class="name">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                        <p class="date text-muted p-0 m-0">
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}<br>
                            {{ date('m/d/Y') }}
                        </p>
                    </div>
                    <div class="sig2">
                        <p class="name">
                            {{ $proposal->accepted_name }}
                        </p>
                        <p class="date text-muted p-0 m-0">
                            {{ $proposal->contact->first_name }} {{ $proposal->contact->last_name }}<br>
                            @if($proposal->status == 'accepted')
                                {{ date('m/d/Y', strtotime($proposal->accepted_date)) }}
                            @else
                                {{ date('m/d/Y') }}
                            @endif
                        </p>
                    </div>
                </div>

            </div>
        </div>





        @if($proposal->status != 'accepted')

            <div class="d-flex justify-content-end align-items-center mt-3">
                <a href="/proposals/{{$proposal->id}}/send" class="btn btn-logo me-2">
                    Send Proposal
                </a>
            </div>

        @endif




    </div>

    @if($proposal->status == 'accepted') 

        <a class="btn btn-primary w-100 mt-3" href="/proposals/{{$proposal->id}}/download/{{$proposal->token}}" target="_blank">Download PDF</a>

    @endif

</div>



@endsection