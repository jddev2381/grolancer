@extends('layouts.dashboard')



@section('content')


<div class="container-fluid p-4">

    <div class="row d-flex align-items-center justify-content-between mb-4">
        <div class="col">
            <h3>Proposals</h3>
        </div>
    </div>





    <div class="row">
        <div class="col-sm-12">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Proposal ID</th>
                        <th>Recipient</th>
                        <th class="text-right">Amount</th>
                        <th class="text-center">Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($proposals->count() > 0)
                        @foreach($proposals as $proposal) 
                            <tr>
                                <td class="align-middle">
                                    {{ $proposal->id }}
                                </td>
                                <td class="align-middle">
                                    <a class="btn btn-dark" href="/contacts/{{ $proposal->contact_id }}">{{ $proposal->contact->first_name }} {{ $proposal->contact->last_name }}</a>
                                </td>
                                <td class="align-middle text-right">
                                        ${{ number_format((float)$proposal->amount, 2, '.', '')  }}
                                </td>
                                <td class="align-middle text-center">
                                    {{ ucwords($proposal->status) }}
                                </td>
                                <td class="align-middle text-center">
                                    <a href="/proposals/{{ $proposal->id }}" class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                            
                                <td class="align-middle text-center">
                                    <form action="/proposals/{{ $proposal->id }}" method="POST">
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
                            <td colspan="6" class="text-center">
                                <span class="text-muted">No Proposals found.</span>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            {{ $proposals->links() }}

        </div>


    </div>







</div>



@endsection