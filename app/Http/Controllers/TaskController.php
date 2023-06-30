<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
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
        $tasks = Task::filterDataProject($request)
            ->orderBy('position', 'ASC')
            ->paginate($this->limit);

        $tasks->appends($request->all());

        $projects = Project::all();

        return view('task.index', compact('tasks', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $projects = Project::all();
        return view('task.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     * @return RedirectResponse
     */
    public function store(TaskRequest $request): RedirectResponse
    {
        $position = $this->getPosition($request);
        $reqMerged = array_merge(
            $request->validated(),
            ['position' => $position]
        );

        Task::create($reqMerged);
        $redirectUrl = route('task.index') . '?project=' . $request->input('project_id');

        return redirect($redirectUrl)->with([
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
        $projects = Project::all();
        return view('task.edit', compact('task', 'projects'));
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
        $task->update($request->validated());
        $redirectUrl = route('task.index') . '?project=' . $task->project_id;

        return redirect($redirectUrl)->with([
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
        // Put project ID
        $projectID = $task->project_id;

        // process delete
        $task->delete();

        // reset position
        $this->resetPosition($projectID);

        return back()->with([
            'message' => 'Task has been successfully deleted'
        ]);
    }

    /**
     * Get position
     *
     * @param TaskRequest $request
     * @return int
     */
    private function getPosition(TaskRequest $request): int
    {
        $position = 1;
        $existPosition = Task::where('project_id', $request->input('project_id'))->count();

        if ($existPosition !== 0) {
            $position = $existPosition + 1;
        }

        return $position;
    }

    /**
     * Process reset position after delete
     *
     * @param int $projectID
     * @return void
     */
    private function resetPosition(int $projectID): void
    {
        $tasks = Task::where('project_id', $projectID)->get();

        if ($tasks) {
            foreach ($tasks as $key => $task) {
                $task->update(['position' => $key + 1]);
            }
        }

    }

    /**
     * Process update position
     *
     * @param Request $request
     * @return void
     */
    public function updatePosition(Request $request)
    {
        if ($request->ajax()) {
            $positions = $request->input('position');

            foreach ($positions as $key => $position) {
                $task = Task::find($position);
                $task->update([
                    'position' => $key + 1
                ]);
            }
        }
    }
}
