@extends('layouts.dashboard')


@section('content')

<div class="container-fluid p-4">

    <div class="row d-flex align-items-center justify-content-between mb-4">
        <div class="col">
            <h3>Update Task</h3>
        </div>
        <div class="col-auto">
            <a href="/tasks" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Tasks
            </a>
        </div>
    </div>

    <div class="row d-flex justify-content-between">

        <div class="col-sm-6">
            <form action="/tasks/{{$task->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="due_date" name="due_date" placeholder="Due Date" value="{{ $task->due_date ? date('Y-m-d', strtotime($task->due_date)) : '' }}">
                    <label for="due_date">Due Date</label>
                    @error('due_date')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Task Name" value="{{ $task->name }}">
                    <label for="name">Task Title</label>
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" style="height: 300px;" placeholder="Description" id="description" name="description">{{ $task->description }}</textarea>
                    <label for="description">Details</label>
                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="true" id="completed" name="completed" {{ $task->completed ? 'checked' : '' }}>
                    <label class="form-check-label" for="completed">
                      Completed
                    </label>
                </div>



                <div class="d-flex justify-content-end mb-3">
                    <button type="submit" class="btn btn-logo">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Update Task
                    </button>
                </div>
            </form>
        </div>


        <div class="col-md-5 col-sm-6">

            @if($task->contact()->exists())

                <div class="person-card mb-3">
                    <h3>{{$task->contact->first_name}}  {{ $task->contact->last_name }}</h3>
                    <h4>{{ $task->contact->type }}</h4>
                    <hr>
                    <p><i class="fa-solid fa-building me-1"></i> {{ $task->contact->company_name }}</p>
                    <p><i class="fa-solid fa-id-card-clip me-1"></i> {{ $task->contact->title }}</p>
                    <p><i class="fa-solid fa-phone me-1"></i> {{ $task->contact->phone }}</p>
                    <hr>
                    <p><i class="fa-solid fa-mobile me-1"></i> {{ $task->contact->mobile }}</p>
                    <p><i class="fa-solid fa-envelope me-1"></i> {{ $task->contact->email }}</p>
                    <p><i class="fa-solid fa-globe me-1"></i> <a href="https://{{$task->contact->website}}" target="_blank">{{ $task->contact->website }}</a></p>
                    <hr>
                    <p class="text-center"><i class="fa-solid fa-map-marker-alt me-1"></i> {{ $task->contact->street }}<br> {{$task->contact->city}} {{$task->contact->state}} {{$task->contact->zip}} </p>
                </div>
                <a href="/contacts/{{$task->contact->id}}" class="btn w-100 btn-primary">
                    <i class="fa-solid fa-eye me-1"></i> View Contact
                </a>
            @endif
        </div>
            
    </div>


@endsection