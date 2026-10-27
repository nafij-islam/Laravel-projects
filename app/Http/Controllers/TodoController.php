<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TodoController extends Controller
{
    // Display a list of all todos
    public function index()
    {
        $todos = Todo::latest()->get();
        return view('todos.index', compact('todos'));
    }

    // Show the form for creating a new todo
    public function create()
    {
        return view('todos.create');
    }

    // Store a newly created todo in the database
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'due_date' => 'nullable|date',
        ]);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $data['attachment'] = $file->store('attachments', 'public');
            $data['attachment_name'] = $file->getClientOriginalName();
        }

        Todo::create($data);

        return redirect()->route('todos.index')->with('success', 'Todo added.');
    }

    // Show the form for editing the specified todo
    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    // Update the specified todo in the database
    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'due_date' => 'nullable|date',
        ]);

        if ($request->hasFile('attachment')) {
            if ($todo->attachment) {
                Storage::disk('public')->delete($todo->attachment);
            }
            $file = $request->file('attachment');
            $data['attachment'] = $file->store('attachments', 'public');
            $data['attachment_name'] = $file->getClientOriginalName();
        }

        $todo->update($data);

        return redirect()->route('todos.index')->with('success', 'Todo updated.');
    }

    // Toggle the completed status of the specified todo
    public function toggle(Todo $todo)
    {
        $todo->update(['is_completed' => ! $todo->is_completed]);

        return redirect()->route('todos.index');
    }

    // Delete the specified todo from the database
    public function destroy(Todo $todo)
    {
        if ($todo->attachment) {
            Storage::disk('public')->delete($todo->attachment);
        }

        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'Todo deleted.');
    }
}
