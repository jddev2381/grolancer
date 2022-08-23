@extends('layouts.dashboard')



@section('content')


<div class="container-fluid p-4">

    <h3>Welcome back {{auth()->user()->first_name}} {{auth()->user()->last_name}}</h3>
    <p class="lead">Edit Your Information</p>

    <form action="/users/update" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ auth()->user()->first_name }}">
                    <label for="first_name">First Name</label>
                    @error('first_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ auth()->user()->last_name }}">
                    <label for="last_name">Last Name</label>
                    @error('last_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-floating  mb-3">                                    
            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="{{ auth()->user()->email }}">
            <label for="email">Email</label>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="row d-flex align-items-center">
            <div class="col-8">
                <div class="mb-3">
                    <label for="avatar" class="form-label">Your Avatar (200 x 200)</label>
                    <input class="form-control" type="file" id="avatar" name="avatar">
                    @error('avatar')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="current-pic-wrapper">
                    <img class="current-pic" src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('img/no-avatar.png') }}" alt="">
                    <a href="/users/avatar/delete" class="btn btn-sm btn-danger">Delete Image</a>
                </div>
                
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <label for="password">Password</label>
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                    <label for="password_confirmation">Confirm Password</label>
                </div>
            </div>
        </div>


        <div class="d-flex justify-content-end mb-3">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save Info</button>
        </div>


    </form>


</div>


@endsection