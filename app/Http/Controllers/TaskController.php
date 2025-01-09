<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $tasks = Auth::user()->tasks()->latest('updated_at')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Auth::user()->tasks()->create($validated);
        return redirect()->route('dashboard')->with('success', 'Task created successfully.');
    }

    public function toggle(Task $task)
    {
        $this->authorize('update', $task);
        $task->update(['completed' => !$task->completed]);
        return redirect()->route('dashboard')->with('success', 'Task status updated.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Task deleted successfully.');
    }
}
