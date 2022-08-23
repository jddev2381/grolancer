@extends('layouts.dashboard')


@section('content')

<div class="container-fluid p-4">

    {{-- <div class="row d-flex align-items-center justify-content-between mb-4">
        <div class="col">
            <h3>{{$contact->first_name}}  {{ $contact->last_name }}</h3>
            <h4 class="text-muted">{{ strtoupper($contact->type) }}</h4>
        </div>
        <div class="col-auto">
            <a href="/contacts/{{$contact->id}}/edit" class="btn btn-logo">
                <i class="fa-solid fa-pen-to-square me-1"></i> Edit
            </a>
        </div>
    </div> --}}

    <div class="row d-flex align-items-center justify-content-between mb-4">
        <div class="col">
            <h3><i class="fa-solid fa-user me-2"></i>Contact Info</h3>
        </div>
        <div class="col-auto">
            <a href="/contacts" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>
       

    <div class="row">
        <div class="col-3">
            <div class="person-card">
                <h3>{{$contact->first_name}}  {{ $contact->last_name }}</h3>
                <h4>{{ $contact->type }}</h4>
                <hr>
                <p><i class="fa-solid fa-building me-1"></i> {{ $contact->company_name }}</p>
                <p><i class="fa-solid fa-id-card-clip me-1"></i> {{ $contact->title }}</p>
                <p><i class="fa-solid fa-phone me-1"></i> {{ $contact->phone }}</p>
                <hr>
                <p><i class="fa-solid fa-mobile me-1"></i> {{ $contact->mobile }}</p>
                <p><i class="fa-solid fa-envelope me-1"></i> {{ $contact->email }}</p>
                <p><i class="fa-solid fa-globe me-1"></i> <a href="https://{{$contact->website}}" target="_blank">{{ $contact->website }}</a></p>
                <hr>
                <p class="text-center"><i class="fa-solid fa-map-marker-alt me-1"></i> {{ $contact->street }}<br> {{$contact->city}} {{$contact->state}} {{$contact->zip}} </p>
            </div>
            <a href="/contacts/{{$contact->id}}/edit" class="btn w-100 btn-logo">
                <i class="fa-solid fa-pen-to-square me-1"></i> Edit
            </a>
            {{-- <table class="table well">
                <tr>
                    <th>Mobile: </th>
                    <td>{{ $contact->mobile }}</td>
                </tr>
                <tr>
                    <th>Phone: </th>
                    <td>{{ $contact->phone }}</td>
                </tr>
                <tr>
                    <th>Email: </th>
                    <td>{{ $contact->email }}</td>
                </tr>
                <tr>
                    <th>Website: </th>
                    <td>{{ $contact->website }}</td>
                </tr>
                <tr>
                    <th>Address: </th>
                    <td>{{ $contact->street }}<br>{{$contact->city}} {{ $contact->state }} {{ $contact->zip }}</td>
                </tr>
            </table> --}}
        </div>
        <div class="col-9">
            <div class="card mb-3">
                <form action="/contacts/{{$contact->id}}/log" method="POST">
                    @csrf
                    <div class="card-header">
                        <h4 class="text-muted">Log Activity</h4>
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="direction" name="direction">
                                        <option value="" hidden>Direction</option>
                                        <option value="inbound">Incoming</option>
                                        <option value="outbound">Outgoing</option>
                                    </select>
                                    @error('direction')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="type" name="type">
                                        <option value="" hidden>Method</option>
                                        <option value="phone">Phone</option>
                                        <option value="email">Email</option>
                                        <option value="other">Other</option>
                                    </select>
                                    @error('type')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                            
                            
                    </div>
                    <div class="card-body">
                        <div class="form-floating">
                            <textarea class="form-control" style="height: 100px;" placeholder="Leave a comment here" id="comment" name="comment"></textarea>
                            <label for="comment">Comments</label>
                            @error('comment')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer d-flex">
                        <button type="submit" class="btn btn-primary ms-auto">Log Activity</button>
                    </div>
                </form>
            </div>



            @foreach($activities as $activity)
                <div class="card mb-3">
                    <div class="card-header d-flex align-items-center justify-content-between styled">
                        <h4 class="text-muted">{{ ucwords($activity->direction) }}</h4>
                        <h5 class="text-muted">{{ ucwords($activity->type) }}</h5>
                        <h6 class="text-muted">{{ $activity->created_at->diffForHumans() }}</h6>
                    </div>
                    <div class="card-body">
                        <p>{{ $activity->comment }}</p>
                    </div>
                    <div class="card-footer d-flex">
                        <form  class="ms-auto" action="/contacts/{{$contact->id}}/log/{{$activity->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach

            
                    


        </div>
    </div>
        

    


</div>


@endsection