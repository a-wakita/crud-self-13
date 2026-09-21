<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    public function update(StoreTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->update($request->validated());

        return redirect()->route('tasks.show', $task);
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function store(StoreTaskRequest $request)
    {
        auth()->user()->tasks()->create($request->validated());

        return redirect()->route('tasks.index');
    }

    public function index()
    {
        $tasks = auth()->user()->tasks()->with('category')->latest()->get();

        $categoryStats = $tasks
            ->groupBy(fn($task) => $task->category?->name ?? '未分類')
            ->map(fn($tasks) => $tasks->count());

        return view('tasks.index', compact('tasks', 'categoryStats'));

    }


}