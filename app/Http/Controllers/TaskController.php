<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display all tasks.
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');

        $tasks = Task::query()
            ->when($filter === 'pending', fn ($q) => $q->where('status', 'Pending'))
            ->when($filter === 'completed', fn ($q) => $q->where('status', 'Completed'))
            ->orderByRaw("due_date IS NULL, due_date asc")
            ->orderByDesc('created_at')
            ->get();

        $stats = [
            'total' => Task::count(),
            'pending' => Task::where('status', 'Pending')->count(),
            'completed' => Task::where('status', 'Completed')->count(),
        ];

        return view('tasks.index', compact('tasks', 'stats', 'filter'));
    }

    /**
     * Show the form to create a new task.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,Completed',
            'due_date' => 'nullable|date',
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Show the form to edit an existing task.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the given task.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,Completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Quickly toggle a task's status between Pending and Completed.
     */
    public function toggleStatus(Task $task)
    {
        $task->update([
            'status' => $task->status === 'Pending' ? 'Completed' : 'Pending',
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task status updated.');
    }

    /**
     * Remove the given task.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
