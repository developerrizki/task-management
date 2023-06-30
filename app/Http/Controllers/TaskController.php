<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private int $limit;

    public function __construct()
    {
        $this->limit = 50;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $tasks = Task::filterDataProject($request)->paginate($this->limit);
        $tasks->appends($request->all());

        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     * @return RedirectResponse
     */
    public function store(TaskRequest $request): RedirectResponse
    {
        Task::create($request->validate());

        return redirect('task.index')->with([
            'message' => 'Task has been successfully created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Task $task
     * @return View
     */
    public function show(Task $task): View
    {
        return view('project.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Task $task
     * @return View
     */
    public function edit(Task $task): View
    {
        return view('task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Task $task
     * @param TaskRequest $request
     * @return RedirectResponse
     */
    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validate());

        return redirect('task.index')->with([
            'message' => 'Task has been successfully updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return RedirectResponse
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect('task.index')->with([
            'message' => 'Task has been successfully deleted'
        ]);
    }
}