<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Contact;

class TasksController extends Controller
{
    // show tasks
    public function index(Request $request) {
        $contacts = Contact::where(['user_id' => auth()->user()->id])->orderBy('last_name')->get();
        $tasks = Task::where('user_id', auth()->user()->id)->orderBy('completed')->orderBy('due_date')->get();
        return view('tasks.index', ['tasks' => $tasks, 'contacts' => $contacts]);
    }
    
    // show create task form
    // public function create() {
    //     return view('tasks.create');
    // }
    
    // create new task
    public function store(Request $request) {
        //dd($request->all());
        // validate form data
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'nullable|max:255',
            'due_date' => 'nullable|date',
            'contact_id' => 'nullable|exists:contacts,id'
        ]);
        // store in the database
        $task = new Task;
        $task->user_id = auth()->user()->id;
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->due_date = $request->input('due_date');
        $task->contact_id = $request->input('contact_id');
        $task->save();
        // redirect to tasks page
        return redirect('/tasks')->with('message', 'Task added to your list');
    }

    // Show single task
    public function show(Task $task) {
        $contacts = Contact::where(['user_id' => auth()->user()->id])->orderBy('last_name')->get();
        $this->checkOwnership($task);
        return view('tasks.show', ['task' => $task, 'contacts' => $contacts]);
    }

    // delete task
    public function destroy(Task $task) {
        $this->checkOwnership($task);
        $task->delete();
        return redirect('/tasks')->with('message', 'Task deleted');
    }

    // mark task completed 
    public function complete(Task $task) {
        $this->checkOwnership($task);
        if($task->completed == 1) {
            $task->completed = 0;
        } else {
            $task->completed = 1;
        }
        $task->save();
        return redirect('/tasks')->with('message', 'Task updated');
    }

    private function checkOwnership(Task $task) {
        if(auth()->user()->id !== $task->user_id) {
            return redirect('/tasks')->with('message', 'Unauthorized access');
        }
    }

    // update task  
    public function update(Request $request, Task $task) {
        //dd($request->all());
        $this->checkOwnership($task);
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'nullable|max:255',
            'due_date' => 'nullable|date',
            'contact_id' => 'nullable|exists:contacts,id'
        ]);
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->due_date = $request->input('due_date');
        $task->contact_id = $request->input('contact_id');
        if(!$request->completed) {
            $task->completed = false;
        } else {
            $task->completed = true;
        }
        $task->save();
        return redirect('/tasks')->with('message', 'Task updated');
    }
}
