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
                <i class="fa-solid fa-arrow-left me-1"></i> Contacts
            </a>
        </div>
    </div>
       

    <div class="row">
        <div class="col-4">
            <div class="person-card mb-3">
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
            <a href="/contacts/{{$contact->id}}/edit" class="btn w-100 btn-logo mb-3">
                <i class="fa-solid fa-pen-to-square me-1"></i> Edit
            </a>


            


            @if($tasks->count() > 0) 
                <button class="btn w-100 btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#tasks">
                    <i class="fa-solid fa-tasks me-1"></i> Tasks ({{ $tasks->where('completed', false)->count() }})
                </button>
            @endif

        

            @if($invoices->count() > 0) 
                <button class="btn w-100 btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#invoices">
                    <i class="fa-solid fa-file-invoice-dollar me-1"></i> Invoices ({{ $invoices->where('paid', false)->count() }})
                </button>
            @endif





        </div>
        <div class="col-8">
            <div class="row">
                <div class="col-6">
                    <button class="btn w-100 btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTask">
                        <i class="fa-solid fa-plus me-1"></i> Add Task
                    </button>
                </div>
                <div class="col-6">
                    <button class="btn w-100 btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addInvoice">
                        <i class="fa-solid fa-plus me-1"></i> Add Invoice
                    </button>
                </div>
            </div>
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
                        <button type="submit" class="btn btn-primary ms-auto"><i class="fa-solid fa-pen me-1"></i> Log Activity</button>
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
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can me-1"></i> Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach

            
                    


        </div>
    </div>
        

    


</div>


<!-- Modal to add invoice -->
<div class="modal fade" id="addInvoice" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Invoice</h5>
                <button type="button" class="close" data-bs-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/invoices" method="POST">
                    @csrf 
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="due_date" name="due_date" placeholder="Due Date" value="{{ old('due_date') }}">
                        <label for="due_date">Due Date</label>
                        @error('due_date')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <input type="hidden" name="contact" value="{{ $contact->id }}">
    
    
                    <div class="d-flex justify-content-end mb-3">
                        <button type="submit" class="btn btn-logo">
                            <i class="fa-solid fa-plus me-1"></i> Create Invoice
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- Modal to add task -->
<div class="modal fade" id="addTask" tabindex="-1">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title">Add Task</h5>
                <button type="button" class="close" data-bs-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                <form action="/tasks/create" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="due_date" name="due_date" placeholder="Due Date" value="{{ old('due_date') }}">
                        <label for="due_date">Due Date</label>
                        @error('due_date')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <input type="hidden" name="contact_id" value="{{ $contact->id }}">
    
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Task Name" value="{{ old('name') }}">
                        <label for="name">Task Title</label>
                        @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <div class="form-floating mb-3">
                        <textarea class="form-control" style="height: 100px;" placeholder="Description" id="description" name="description">{{ old('description') }}</textarea>
                        <label for="description">Details</label>
                        @error('description')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <button type="submit" class="btn btn-logo">
                            <i class="fa-solid fa-plus me-1"></i> Create Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal for tasks -->
<div class="modal fade" id="tasks" tabindex="-1" role="dialog" aria-labelledby="tasksLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tasksLabel">Tasks</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-muted">Tasks</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            @foreach($tasks as $task)
                                                <tr>
                                                    @if($task->completed)
                                                        <td><strike>{{ $task->name }}</strike></td>
                                                    @else
                                                        <td>{{ $task->name }}</td>
                                                    @endif
                                                    <td class="align-middle text-center">
                                                        <a href="/tasks/{{$task->id}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-eye"></i></a>    
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>






<!-- Modal for Invoices -->
<div class="modal fade" id="invoices" tabindex="-1" role="dialog" aria-labelledby="tasksLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tasksLabel">Invoices</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-muted">Invoices</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            @foreach($invoices as $invoice)
                                                <tr>  
                                                    <td>{{ $invoice->id}}</td>
                                                    <td>
                                                        @if($invoice->paid)
                                                            <s>${{ number_format((float)$invoice->lineItems->sum('amount'), 2, '.', '')  }}</s>
                                                        @else
                                                            ${{ number_format((float)$invoice->lineItems->sum('amount'), 2, '.', '')  }}
                                                        @endif
                                                    </td>
                                                    
                                                    <td class="align-middle text-center">
                                                        <a href="/invoices/{{$invoice->id}}/create" class="btn btn-sm btn-primary"><i class="fa-solid fa-eye"></i></a>    
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <form action="/invoices/{{$invoice->id}}/pay" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-sm btn-success">
                                                                <i class="fa-solid fa-dollar-sign"></i>
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
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection