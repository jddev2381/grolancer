@extends('layouts.dashboard')


@section('content')

<div class="container-fluid p-4">

    <div class="row d-flex align-items-center justify-content-between mb-4">
        <div class="col">
            @if(isset($_GET['type']))
                <h3>{{ ucwords($_GET['type']) }}s</h3>
            @else
                <h3>All Contacts</h3>
            @endif
        </div>
        <div class="col-auto">
            <a href="/contacts/create" class="btn btn-logo">
                <i class="fa-solid fa-user-plus me-1"></i> Add Contact
            </a>
        </div>
    </div>

    @if(isset($_GET['search'])) 

        <h4 class="text-center mb-4">Showing Results For: <span class="ms-2">{{ $_GET['search'] }}</span></h4>

    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users me-1"></i> 
            @if(isset($_GET['type']))
                {{ ucwords($_GET['type']) }}s
            @else
                Contacts
            @endif
        </div>
        <div class="card-body">
            <table id="datatablesSimplesss" class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email Address</th>
                        <th class="text-center">Tasks</th>
                        <th class="text-center">Type</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($contacts->count() > 0)
                        @foreach($contacts as $contact)
                            <tr>
                                <td><a class="btn btn-dark w-100" href="/contacts/{{$contact->id}}">{{ $contact->first_name }} {{ $contact->last_name }}</a></td>
                                <td>{{ $contact->mobile }}</td>
                                <td>{{ $contact->email }}</td>  
                                <td class="text-center">{{ $contact->tasks->where('completed', false)->count() }}</td>
                                <td><a class="btn btn-sm w-100 btn-info" href="/contacts?type={{$contact->type}}">{{ strtoupper($contact->type) }}</a></td>
                                <td class="text-center">
                                    {{-- <a href="/contacts/{{ $contact->id }}/edit" class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-edit me-1"></i> Edit
                                    </a> --}}
                                    <form action="/contacts/{{ $contact->id }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">No Contacts Found</td>
                        </tr>
                    @endif
                    
                    
                </tbody>
            </table>
            {{ $contacts->appends($_GET)->links() }}
        </div>
    </div>



</div>


@endsection