@extends('layouts.dashboard')



@section('content')


<div class="container-fluid p-4">

    <h3>Welcome back {{auth()->user()->first_name}} {{auth()->user()->last_name}}</h3>
    

    <form action="/users/update" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
        
                <p class="lead">Edit Your Information</p>
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
                            <a href="/users/avatar/delete" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                        
                    </div>
                </div>

            </div>
            <div class="col-6">
                <p class="lead">Business Info</p>

                <div class="form-floating  mb-3">                                    
                    <input type="text" class="form-control" id="business_name" name="business_name" placeholder="Your Business Name" value="{{ auth()->user()->business_name }}">
                    <label for="business_name">Business Name</label>
                    @error('business_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row d-flex align-items-center">
                    <div class="col-8">
                        <div class="mb-3">
                            <label for="logo" class="form-label">Your Business Logo</label>
                            <input class="form-control" type="file" id="logo" name="logo">
                            @error('logo')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="current-logo-wrapper">
                            <img class="current-logo" src="{{ auth()->user()->logo ? asset('storage/' . auth()->user()->logo) : asset('img/no-avatar.png') }}" alt="">
                            <a href="/users/logo/delete" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <p class="lead">Invoicing</p>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="paypal_link" name="paypal_link" placeholder="Paypal Link" value="{{ auth()->user()->paypal_link }}">
                    <label for="paypal_link">PayPal Link</label>
                    @error('paypal_link')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <span class="input-group-text">$</span>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="cashapp_tag" name="cashapp_tag" placeholder="Cash App Tag" value="{{ auth()->user()->cashapp_tag }}">
                        <label for="cashapp_tag">Cash App Tag</label>
                        @error('cashapp_tag')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>



        <hr>
        <p class="lead">Reset Password</p>
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