<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
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
    public function index(): View
    {
        $projects = Project::paginate($this->limit);

        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest $request
     * @return RedirectResponse
     */
    public function store(ProjectRequest $request): RedirectResponse
    {
        Project::create($request->validate());

        return redirect('project.index')->with([
            'message' => 'Project has been successfully created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return View
     */
    public function show(Project $project): View
    {
        return view('project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return View
     */
    public function edit(Project $project): View
    {
        return view('project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Project $project
     * @param ProjectRequest $request
     * @return RedirectResponse
     */
    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $project->update($request->validate());

        return redirect('project.index')->with([
            'message' => 'Project has been successfully updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return RedirectResponse
     */
    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect('project.index')->with([
            'message' => 'Project has been successfully deleted'
        ]);
    }
}
