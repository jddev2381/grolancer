@extends('layouts.dashboard')


@section('content')

<div class="container-fluid p-4">

    <div class="row d-flex align-items-center justify-content-between mb-4">
        <div class="col">
            <h3>Contacts</h3>
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
            <i class="fa-solid fa-users me-1"></i> Contacts
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Company</th>
                        <th>Mobile</th>
                        <th>Email Address</th>
                        <th>Website</th>
                        <th>Type</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Company</th>
                        <th>Mobile</th>
                        <th>Email Address</th>
                        <th>Website</th>
                        <th>Type</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td><a href="/contacts/{{$contact->id}}">{{ $contact->first_name }} {{ $contact->last_name }}</a></td>
                            <td>{{ $contact->title }}</td>
                            <td>{{ $contact->company_name }}</td>
                            <td>{{ $contact->mobile }}</td>
                            <td>{{ $contact->email }}</td>  
                            <td>{{ $contact->website }}</td>
                            <td>{{ $contact->type }}</td>
                            <td class="text-center">
                                <a href="/contacts/{{ $contact->id }}/edit" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-edit me-1"></i> Edit
                                </a>
                                <form action="/contacts/{{ $contact->id }}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa-solid fa-trash-alt me-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    
                    
                </tbody>
            </table>
        </div>
    </div>



</div>


@endsection