<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Notifications\NewTask;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
          return Inertia::render("Task/Index",[
            "tasks" => Task::where(["user_id"=> $request->user()->id])->with("user:id,name")->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
        ]);
        $request->user()->tasks()->create($validated);
        //$request->user()->notify(new NewTask($task));
        return redirect(route('tasks.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        Gate::authorize('update', $task);
 
        $validated = $request->validate([
            'description' => 'required|string|max:255',
        ]);
 
        $task->update($validated);
 
        return redirect(route('tasks.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        Gate::authorize('delete', $task);
 
        $task->delete();
 
        return redirect(route('tasks.index'));
    }
}
