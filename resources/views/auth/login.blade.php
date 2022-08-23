@extends('layouts.auth')



@section('content')


    <div class="container">
        <div class="row vh-100 d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <img src="img/grolancer-logo.png" alt=""> Login
                    </div>
                    <div class="box-body">
                        <form action="/users/authenticate" method="POST">
                            @csrf
                            
                            
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}">
                                <label for="email">Email Address</label>
                                @error('email')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                                   
                            
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <label for="password">Password</label>
                                @error('password')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                                
                                    
                            <div class="d-flex justify-content-end mb-3">
                                <button type="submit" class="btn btn-logo">Login</button>
                            </div>

                            <a href="/register">Need an account? Create one.</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>      
    </div>



@endsection