@extends('layouts.dashboard')


@section('content')

<div class="container-fluid p-4">
        
    <div class="row d-flex align-items-center justify-content-between mb-4">
        <div class="col">
            <h3>Tasks</h3>
        </div>
        <div class="col-auto">
            <button href="/tasks/create" class="btn btn-logo" data-bs-toggle="modal" data-bs-target="#addTask">
                <i class="fa-solid fa-plus me-1"></i> Create Task
            </button>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">


            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Due Date</th>
                        <th class="text-center">Associated With</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @if($tasks->count() > 0)
                        @foreach($tasks as $task) 
                            <tr>
                                <td class="align-middle">
                                    @if($task->completed)
                                        <s>{{ $task->name }}</s>
                                    @else
                                        <span data-bs-toggle="tooltip" title="{{ $task->description }}">{{ $task->name }}</span>
                                    @endif
                                </td>
                                <td class="align-middle">{{ $task->due_date ? date('m/d/Y', strtotime($task->due_date)) : '' }}</td>
                                <td class="align-middle text-center"> 
                                    @if($task->contact_id)
                                        <a class="btn btn-sm btn-dark" href="/contacts/{{ $task->contact_id }}">{{ $task->contact->first_name }} {{ $task->contact->last_name }}</a>
                                    @else
                                        <span class="text-muted">NA</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    <a href="/tasks/{{ $task->id }}" class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                                <td class="align-middle text-center">
                                    <form action="/tasks/{{$task->id}}/complete" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-success"> 
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="align-middle text-center">
                                    <form action="/tasks/{{ $task->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
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
                                <span class="text-muted">No tasks found</span>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        
            {{ $tasks->links() }}
            
        </div>

    </div>

</div>









<!-- Modal To Add Task -->
<div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="tasksLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tasksLabel">Add Task</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
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
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-logo">
                            <i class="fa-solid fa-plus me-1"></i> Add Task
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>











@endsection