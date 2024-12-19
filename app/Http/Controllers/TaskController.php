<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use OpenAI\Client;

class TaskController extends Controller
{

    // EXTRA FUNCTIONS AT THE BOTTOM
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1️⃣ import task model // $tasks = Task::all();
        $sortField = $request->query('sort_by', 'created_at'); // Default sort by created_at
        $sortOrder = $request->query('sort_order', 'desc'); // Default sort order descending
        $filterStatus = $request->query('filter_status');
        $searchQuery = $request->query('search');

        $tasks = Task::query();

        // 🔍 Apply search filter
        if (!empty($searchQuery)) {
            $tasks->where('title', 'LIKE', '%' . $searchQuery . '%');
        }


        // 🎯 Apply status filter
        if ($filterStatus) {
            $tasks->where('status', $filterStatus);
        }

        // 🧹 Apply sorting
        $tasks->orderBy($sortField, $sortOrder);

        // 📋 Paginate results
        $tasks = $tasks->paginate(10);

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
            'category' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        if (empty($validated['description'])) {
            $validated['description'] = generateAIDescription($validated['title'], $validated['deadline']);
        }

        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        // Create the task - $task->create($validated);
        Task::create($validated);

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
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        if ($request->hasFile('attachment')) {
            if ($task->attachment) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($task->attachment);
            }
        }

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

    public function toggleStatus(Task $task)
    {
        // $variable = (condition) ? value_if_true : value_if_false;
        $task->status = $task->status === 'pending' ? 'completed' : 'pending';

        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task status has been updated');
    }

    public function overview()
    {
        // fetch overdue/today/upcoming
        $overdueTasks = Task::where('deadline', '<', now())->whereNotNull('deadline')->get();

        $todayTasks = Task::whereDate('deadline', now())->get();

        $upcomingTasks = Task::whereBetween('deadline', [now(), now()->addDays(7)])->get();

        // Count tasks by category
        $categoryCounts = Task::select('category', DB::raw('count(*) as total'))->groupBy('category')->get();

        return view('tasks.overview', compact('overdueTasks','todayTasks','upcomingTasks', 'categoryCounts'));
    }

    public function filter(Request $request)
    {
        $filter = $request->query('filter'); //get filter from the query

        $tasks = Task::query(); //start a query for the Task model

        // filter logic
        if ($filter === 'overdue') {
            $tasks->where('deadline', '<', now());
        } elseif ($filter === 'today') {
            $tasks->whereDate('deadline', now());
        } elseif ($filter === 'upcoming') {
            $tasks->whereBetween('deadline', [now(), now()->addDays(7)]);
        } elseif ($filter === 'category') {
            $tasks->whereNotNull('category');
        }

        $tasks = $tasks->get(); //execute query

        return view('tasks.index', ['tasks' => $tasks, 'filter' => $filter]);
    }

    public function deleteAttachment(Task $task)
    {
        if ($task->attachment) {
            // delete  file from storage
            Storage::disk('public')->delete($task->attachment);

            // remove attachment field from database
            $task->update(['attachment' => null]);

            return redirect()->back()->with('success', 'Attachment deleted');
        }

        return redirect()->back()->with('error', 'No attachment found');
    }
}
