<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\TimeSlotController;
use App\Http\Controllers\ForumTopicController;

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

Route::get('/users/logo/delete', [UserController::class, 'deleteLogo'])->middleware('auth');



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

// Show Tasks
Route::get('/tasks', [TasksController::class, 'index'])->middleware('auth');

// Show create task form
Route::post('/tasks/create', [TasksController::class, 'store'])->middleware('auth');

// Show Single Task
Route::get('/tasks/{task}', [TasksController::class, 'show'])->middleware('auth');

// update task info 
Route::put('/tasks/{task}', [TasksController::class, 'update'])->middleware('auth');

// Delete Task  
Route::delete('/tasks/{task}', [TasksController::class, 'destroy'])->middleware('auth');

// Mark Task as Completed
Route::put('/tasks/{task}/complete', [TasksController::class, 'complete'])->middleware('auth');


// Show Invoices
Route::get('/invoices', [InvoicesController::class, 'index'])->middleware('auth');

// Delete Invoice
Route::delete('/invoices/{invoice}', [InvoicesController::class, 'destroy'])->middleware('auth');


Route::get('/invoices/{invoice}/create', [InvoicesController::class, 'addLineItem'])->middleware('auth');

Route::post('/invoices/{invoice}/create', [InvoicesController::class, 'storeLineItem'])->middleware('auth');

// Toggle paid invoice
Route::put('/invoices/{invoice}/pay', [InvoicesController::class, 'togglePaid'])->middleware('auth');

// Create new invoice
Route::post('/invoices', [InvoicesController::class, 'store'])->middleware('auth');

Route::delete('/invoices/{invoice}/items/{item}', [InvoicesController::class, 'deleteLineItem'])->middleware('auth');

Route::get('/invoices/{invoice}/download', [InvoicesController::class, 'downloadInvoice'])->middleware('auth');




// Show Proposal
Route::get('/proposals', [ProposalController::class, 'index'])->middleware('auth');

// Store Proposal
Route::post('/proposals', [ProposalController::class, 'store'])->middleware('auth');

// Show Single Proposal
Route::get('/proposals/{proposal}', [ProposalController::class, 'show'])->middleware('auth');

// Add Section to Proposal
Route::post('/proposals/{proposal}/sections', [ProposalController::class, 'addSection'])->middleware('auth');

// Edit proposal section
Route::get('/proposals/{proposal}/sections/{section}/edit', [ProposalController::class, 'editSection'])->middleware('auth');

// Update proposal section
Route::put('/proposals/{proposal}/sections/{section}/edit', [ProposalController::class, 'updateSection'])->middleware('auth');

// Delete Proposal Section
Route::delete('/proposals/{proposal}/sections/{section}', [ProposalController::class, 'deleteSection'])->middleware('auth');

// Delete Proposal
Route::delete('/proposals/{proposal}', [ProposalController::class, 'destroy'])->middleware('auth');



// Customer Facing Proposal View
Route::get('/proposal/{proposal}/view/{token}', [ProposalController::class, 'viewProposal']);

// Customer Accept Proposal
Route::post('/proposal/{proposal}/view/{token}', [ProposalController::class, 'acceptProposal']);

// Send Proposal
Route::get('/proposals/{proposal}/send', [ProposalController::class, 'sendProposal'])->middleware('auth');

// Download Proposal
Route::get('/proposals/{proposal}/download/{token}', [ProposalController::class, 'downloadProposal']);

// Timing
Route::get('/timing', [TimeSlotController::class, 'index'])->middleware('auth');

// Create new time slot
Route::post('/timing', [TimeSlotController::class, 'store'])->middleware('auth');

// Stop Timer
Route::get('/timing/{timeSlot}/stop', [TimeSlotController::class, 'stopTimer'])->middleware('auth');

// Delete Time Slot
Route::delete('/timing/{timeSlot}', [TimeSlotController::class, 'destroy'])->middleware('auth');

// Mark Timer Billed
Route::put('/timing/{timeSlot}/billed', [TimeSlotController::class, 'markBilled'])->middleware('auth');

// Show Forum
Route::get('/forum', [ForumTopicController::class, 'index'])->middleware('auth');

// Create new forum topic
Route::get('/forum/create', [ForumTopicController::class, 'create'])->middleware('auth');

// Store new forum topic
Route::post('/forum/create', [ForumTopicController::class, 'store'])->middleware('auth');