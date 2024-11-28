<?php

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:tasks',
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required',
            'priority' => 'required',
            'finality' => 'required',
        ]);

        return Task::create($request->all());
    }

    public function show(Task $task)
    {
        return $task;
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'code' => 'required|unique:tasks,code,' . $task->id,
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required',
            'priority' => 'required',
            'finality' => 'required',
        ]);

        $task->update($request->all());
        return $task;
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->noContent();
    }
}