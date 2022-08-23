@extends('layouts.auth')



@section('content')


    <div class="container">
        <div class="row vh-100 d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <img src="img/grolancer-logo.png" alt=""> Register
                    </div>
                    <div class="box-body">
                        <form action="/users" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ old('first_name') }}">
                                        <label for="first_name">First Name</label>
                                        @error('first_name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
                                        <label for="last_name">Last Name</label>
                                        @error('last_name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ old('username') }}">
                                    <label for="username">Username</label>
                                    @error('username')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="form-floating  mb-3">                                    
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}">
                                    <label for="email">Email</label>
                                    @error('email')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
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


                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="terms_and_conditions" name="terms_and_conditions">
                                <label class="form-check-label" for="gridCheck">
                                    I agree to the <a href="#" target="_blank">Terms and Conditions</a>.
                                </label>
                                @error('terms_and_conditions')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end mb-3">
                                <button type="submit" class="btn btn-logo">Register</button>
                            </div>

                            <a href="/login">Already have an account?</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>      
    </div>



@endsection