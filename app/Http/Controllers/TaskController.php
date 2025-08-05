<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Task/Index', [
            'tasks' => auth()->user()->tasks()->with(['user', 'tags'])
            ->when($request->search, function ($query, $task){
                $query->where('name', 'LIKE', '%' .$task. '%');
            })->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Task/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        auth()->user()->tasks()->create($request->validated());

        return redirect()->route('tasks.index')->with('message', 'Task has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): Response
    {
        $this->authorize('show', $task);

        // Eager load the required data.
        $task->load(['user', 'tags']);

        return Inertia::render('Task/Show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): Response
    {
        $this->authorize('edit', $task);

        // Eager load the assigned tags.
        $task->load('tags');

        // Filter all tags created by the authenticated user
        // and collect only non-attached ones.
        $availableTags = auth()->user()->tags->diff($task->tags);

        return Inertia::render('Task/Edit', [
            'task' => $task,
            'availableTags' => $availableTags
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $task->update($request->validated());

        return redirect()->route('tasks.index')->with('message', 'Task details updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('message', 'Task has been deleted');
    }

    /**
     * Handle the task status by either completing it
     * or changing back to pending state.
     */
    public function handleStatus(Task $task): RedirectResponse
    {
        $task->complete === 1 ?
            $task->update(['complete' => 0]) :
            $task->update(['complete' => 1]);

        return back()->with('message', 'Task status updated');
    }

    /**
     * Attach a tag to the task.
     */
    public function addTag(Task $task, Tag $tag): RedirectResponse
    {
        // Avoid attaching duplicates.
        $task->tags()->syncWithoutDetaching($tag->id);

        return redirect()->back();
    }

    /**
     * Remove a tag from the task.
     */
    public function removeTag(Task $task, Tag $tag): RedirectResponse
    {
        $task->tags()->detach($tag->id);

        return redirect()->back();
    }
}
