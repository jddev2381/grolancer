@extends('layouts.dashboard')


@section('content')

<div class="container-fluid p-4">

    <div class="row d-flex align-items-center justify-content-between mb-4">
        <div class="col">
            <h3>Update Task</h3>
        </div>
        <div class="col-auto">
            <a href="/tasks" class="btn btn-logo">
                <i class="fa-solid fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    <div class="row d-flex align-items-center">

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
                    <select class="form-select" id="contact_id" name="contact_id">
                        <option value="">Select Contact</option>
                        @foreach($contacts as $contact)
                            <option value="{{ $contact->id }}" {{ $task->user_id == $contact->id ? 'selected' : '' }}>
                                {{ $contact->last_name }}, {{ $contact->first_name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="type">Type</label>
                    @error('type')
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
                    <textarea class="form-control" style="height: 100px;" placeholder="Description" id="description" name="description">{{ $task->description }}</textarea>
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
            
    </div>


@endsection