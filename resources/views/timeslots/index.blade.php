@extends('layouts.dashboard')



@section('content')


<div class="container-fluid p-4">

    <div class="row d-flex align-items-center justify-content-between mb-4">
        <div class="col">
            <h3>Timers</h3>
        </div>
        <div class="col-auto">
            <a href="#" class="btn btn-logo" data-bs-toggle="modal" data-bs-target="#trackTime">
                <i class="fa-solid fa-stopwatch me-1"></i> Track Time
            </a>
        </div>
    </div>


    <table class="table table-striped">
        <thead>
            <tr>
                <th>Contact</th>
                <th>Description</th>
                <th>Start Time</th>
                <th>Stop Time</th>
                <th class="text-center">Time</th>
                <th>Status</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if($slots->count() > 0)
                @foreach($slots as $slot)
                    <tr>
                        <td><a class="btn btn-link" href="/contacts/{{ $slot->contact->id }}">{{ $slot->contact->first_name }} {{ $slot->contact->last_name }}</a></td>
                        <td>{{ $slot->name }}</td>
                        <td>{{ $slot->start_time }} UTC</td>
                        <td>{{ $slot->end_time }} UTC</td>
                        <td class="text-center">
                            @if($slot->end_time == null)
                                <a href="/timing/{{$slot->id}}/stop" class="btn btn-success">Stop Timer</a>    
                            @else
                                @php
                                    $time = $slot->start_time->diffInSeconds($slot->end_time)
                                @endphp 
                                {{ gmdate("H:i:s", $time) }}
                            @endif
                        </td>
                        <td>{{ ucwords($slot->status) }}</td>
                        <td>
                            <form action="/timing/{{$slot->id}}/billed" method="POST">
                                @csrf 
                                @method('PUT')
                                <button type="submit" class="btn btn-success">
                                    <i class="fa-solid fa-hand-holding-dollar"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <!-- Delete Timer -->
                            <form action="/timing/{{ $slot->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">
                        No entries found
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
    

</div>



<!-- Modal to add Proposal -->
<div class="modal fade" id="trackTime" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Track Time</h5>
                <button type="button" class="close" data-bs-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/timing" method="POST">
                    @csrf 

                    <div class="form-floating mb-3">
                        <select class="form-select" id="contact_id" name="contact_id">
                            <option selected>Select A Client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->last_name }}, {{ $client->first_name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelect">Client</label>
                        @error('contact_id')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                        <label for="name">What are you working on?</label>
                        @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>


    
    
                    <div class="d-flex justify-content-end mb-3">
                        <button type="submit" class="btn btn-logo">
                            <i class="fa-solid fa-stopwatch me-1"></i> Start Timer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection