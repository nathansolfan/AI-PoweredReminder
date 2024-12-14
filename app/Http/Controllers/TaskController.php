<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use OpenAI\Client;

class TaskController extends Controller
{
    // // OPENAI __CONSTRUCT
    // public function __construct()
    // {
    //     $this->openAIClient = \OpenAI::client(config('services.openai.api.key'));
    // }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1️⃣ import task model
        $tasks = Task::all();
        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 2️⃣
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Task $task)
    {
        // 3️⃣
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:pending, completed',
            // 'priority' => 'required|in:low,medium,high',
            'deadline' => 'nullable|date',
            'category' => 'nullable|string'
        ]);

        if (empty($validated['description'])) {
            $validated['description'] = generateAIDescription($validated['title'], $validated['deadline']);
        }

        // Create the task - $task->create($validated);
        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => $validated['status'],
            'priority' => $validated['priority'],
            'deadline' => $validated['deadline'],
    ]);
        // redirect
        return redirect()->route('tasks.index')->with('success', 'Task Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // 4️⃣
        return view('tasks.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        // 5️⃣
        return view('tasks.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // 6️⃣

        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:pending, completed',
            'priority' => 'required|in:low,medium,high',
            'deadline' => 'nullable|date',
        ]);

        $task->update($validated);
        return redirect()->route('tasks.index')->with('success', 'Task updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //7️⃣
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted');
    }
}
