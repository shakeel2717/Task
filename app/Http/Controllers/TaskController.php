<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::latest()->paginate(4);
        return view('task.index', compact('tasks'));
    }

    public function active()
    {
        $tasks = Task::where('status', 'pending')->latest()->paginate(4);
        return view('task.active', compact('tasks'));
    }

    public function completed()
    {
        $tasks = Task::where('status', 'completed')->latest()->paginate(4);
        return view('task.completed', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = new Task();
        $task->user_id = 1;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = 'pending';
        $task->save();

        return redirect()->back()->with('success', 'Task created successfully.');
    }

    public function complete(Task $task)
    {
        $task->status = 'completed';
        $task->save();

        return redirect()->back()->with('success', 'Task completed successfully.');
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
        return view('task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        // update task
        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();

        return redirect()->back()->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully.');
    }
}
