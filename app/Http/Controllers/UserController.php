<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show Register User Form
    public function create() {
        return view('auth.register');
    }

    // Show login form
    public function login() {
        return view('auth.login');
    }

    // Log user in
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/dashboard')->with('message', 'You are now logged in!');
        }
        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out.');
    }

    // Process user registration
    public function store(Request $request) {
        // Validate form data
        $formFields = $request->validate([
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'username' => 'required|min:3|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'terms_and_conditions' => 'accepted',
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        // Create new user
        $user = User::create($formFields);

        // Login User
        auth()->login($user);

        return redirect('/dashboard')->with('message', 'User created and logged in!');
    }

    // Show edit user info
    public function edit() {
        return view('users.edit');
    }

    // Update user info
    public function update(Request $request) {
        $formFields = $request->validate([
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(auth()->user()->id),
            ],
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|dimensions:width=200,height=200',
            'business_name' => 'nullable|min:2',
            'logo' => 'image|mimes:jpeg,png,jpg,gif',
            'password' => 'nullable|min:8|confirmed',
        ]);
        //dd($formFields);
        if(!empty($formFields['password'])) {
            $formFields['password'] = bcrypt($formFields['password']);
        } else {
            unset($formFields['password']);
        }
        if($request->hasFile('avatar')) {
            $formFields['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        auth()->user()->update($formFields);
        return redirect('/users/edit')->with('message', 'User updated!');
    }

    // delete avatar {
    public function deleteAvatar(Request $request) {
        auth()->user()->update(['avatar' => null]);
        return redirect('/users/edit')->with('message', 'Avatar deleted!');
    }
}
