@extends('layouts.dashboard')

@section('content')

<div class="container-fluid p-4">

    <div class="row d-flex align-items-center justify-content-between mb-4">
        <div class="col">
            <h3>New Forum Topic</h3>
        </div>
        <div class="col-auto">
            <a href="/forum" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Forum
            </a>
        </div>
    </div>


    <div class="row">


        <div class="col-sm-8">
            <form action="/forum/create" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Topic" value="{{ old('title') }}">
                    <label for="title">Topic</label>
                    @error('title')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" id="description" name="description" style="height: 350px;" placeholder="Discussion">{{ old('description') }}</textarea>
                    <label for="description">Discussion</label>
                    @error('body')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-logo">Submit</button>
                </div>
            </form>
        </div>

        <div class="col-sm-4">
            <h3>Forum Rules</h3>
            <p class="lead">
                Please take the time to read the pinned forum rules before posting. Posting here is a privilege, not a right. If you do not follow the rules, you will be banned from the forum.
            </p>
            
        </div>



</div>

@endsection