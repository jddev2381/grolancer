@extends('layouts.dashboard')



@section('content')



<div class="container-fluid p-4">
    
    <div class="row d-flex align-items-center justify-content-between">        
        
        <div class="col-md-4 col-sm-6">
            <div class="card bg-primary text-white dashboard-card mb-4">
                <div class="card-body">
                    <span class="count">{{ $contacts->where('type', 'prospect')->count() }}</span>
                </div>
                <div class="card-footer">
                    <h4>Prospects</h4>
                </div>
            </div>
        </div>


        <div class="col-md-4 col-sm-6">
            <div class="card bg-warning text-white dashboard-card mb-4">
                <div class="card-body">
                    <span class="count">{{ $contacts->where('type', 'lead')->count() }}</span>
                </div>
                <div class="card-footer">
                    <h4>Leads</h4>
                </div>
            </div>
        </div>


        <div class="col-md-4 col-sm-6">
            <div class="card bg-success text-white dashboard-card mb-4">
                <div class="card-body">
                    <span class="count">{{ $contacts->where('type', 'client')->count() }}</span>
                </div>
                <div class="card-footer">
                    <h4>Clients</h4>
                </div>
            </div>
        </div>




    </div>




</div>


@endsection