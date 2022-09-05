@extends('layouts.dashboard')

@section('content')


<div class="container-fluid p-4">

    <div class="row d-flex align-items-center justify-content-end mb-4">
        
        <div class="col-auto">
            <a href="/proposals/{{$proposal->id}}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> To Proposal
            </a>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa-solid fa-pen-to-square me-1"></i> Edit Section</h3>
        </div>
        <div class="card-body">

            <form action="/proposals/{{ $proposal->id }}/sections/{{ $section->id }}/edit" method="POST">
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $section->title }}">
                    <label for="title">Section Title</label>
                    @error('title')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" id="body" name="body" placeholder="Create Section Here" rows="3">{{ $section->body }}</textarea>
                    <label for="body">Section Body</label>
                    @error('body')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mt-2">Save</button>
                </div>
            </form>

        </div>
    </div>


</div>

@endsection