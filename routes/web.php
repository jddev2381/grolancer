<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ContactsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', [PagesController::class, 'index'])->name('dashboard');

// Show Register User Form
Route::get('/register', [UserController::class, 'create'])->name('register')->middleware('guest');

// Show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');



// Create new user
Route::post('/users', [UserController::class, 'store']);

// Log user in
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Show edit user info
Route::get('/users/edit', [UserController::class, 'edit'])->middleware('auth');

// Update user info 
Route::post('/users/update', [UserController::class, 'update'])->middleware('auth');

// Show billing page
Route::get('/users/billing', [PagesController::class, 'billing'])->middleware('auth');

Route::get('/users/avatar/delete', [UserController::class, 'deleteAvatar'])->middleware('auth');



// Show Contacts
Route::get('/contacts', [ContactsController::class, 'index'])->middleware('auth');

// Show create contact form
Route::get('/contacts/create', [ContactsController::class, 'create'])->middleware('auth');

// Create new contact
Route::post('/contacts', [ContactsController::class, 'store'])->middleware('auth');

// Delete a contact
Route::delete('/contacts/{contact}', [ContactsController::class, 'destroy'])->middleware('auth');

// Show Single Contact
Route::get('/contacts/{contact}', [ContactsController::class, 'show'])->middleware('auth');

// Show contact edit form
Route::get('/contacts/{contact}/edit', [ContactsController::class, 'edit'])->middleware('auth');

// Update contact info
Route::put('/contacts/{contact}', [ContactsController::class, 'update'])->middleware('auth');

// Log Activity for contact
Route::post('/contacts/{contact}/log', [ContactsController::class, 'logActivity'])->middleware('auth');

// Delete Activity for contact
Route::delete('/contacts/{contact}/log/{activity}', [ContactsController::class, 'deleteActivity'])->middleware('auth');